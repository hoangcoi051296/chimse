<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['title', 'status', 'description', 'price', 'district_id', 'ward_id','addressDetails', 'category_id', 'employee_id', 'customer_id', 'time'];
    const DaHuy = 0;
    const ChoDuyet = 1;
    const DaDuyet = 2;
    const TimDuocNGV = 3;
    const NGVXacNhanCV = 4;
    const NGVBatDau = 5;
    const NGVKetThuc = 6;
    const NTXacNhan = 7;
    const PerPage = 10;

    public function getData($condition)
    {
        $posts = $this->query()->orderBy('created_at', 'desc');
        if (!$condition) {
            return $posts->paginate(isset($condition['per_page']) ? $condition['per_page'] : $this->perPage);
        }

        if (isset($condition['timeFilter'])){
            if ($condition['timeFilter']=='day'){
                $posts->where('created_at','>=',Carbon::now()->subDay(1));
            }
            elseif ($condition['timeFilter']=='week'){
                $posts->where('created_at','>=',Carbon::now()->subWeek(1));
            }
            else{
            $posts->where('created_at','>=',Carbon::now()->subMonth(1));
            }
        }
        if (isset($condition['status']) && $condition['status'] !== null) {
            $posts = $posts->where('status', $condition['status']);
        }
        if (isset($condition['time']) && $condition['time'] !== null) {
            $posts = $posts->where('time', date('Y-m-d H:i:s', strtotime($condition['time'])));
        }
        if (isset($condition['district']) && $condition['district'] !== null) {
            $posts = $posts->where('district_id', $condition['district']);
        }
        if (isset($condition['ward']) && $condition['ward'] !== null) {
            $posts = $posts->where('ward_id', $condition['ward']);
        }
        if (isset($condition['search']) && $condition['search'] !== null) {
            $search = $condition['search'];
            $posts->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', '%' . $search . '%')
                    ->orwhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('ward', function ($query) use ($search) {
                        $query->whereHas('district', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        });
                    })
                    ->orWhereHas('customer', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('employee', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            });
        }
        if (isset($condition['customer_id']) && $condition['customer_id'] !== null) {
            $posts->where('customer_id', $condition['customer_id']);
        }
        return $posts->paginate(isset($condition['per_page']) ? $condition['per_page'] : $this->perPage);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function ward()
    {
        return $this->hasOne("\App\Models\Ward", 'xaid', 'ward_id');
    }

    public function district()
    {
        return $this->hasOne(District::class, 'maqh', 'district_id');
    }

    public function rating()
    {
        return $this->hasMany(Feedback::class, 'post_id', 'id');
    }

    public function avgRate()
    {
        return $this->rating()->avg('rating');
    }

    public function rules($id = null)
    {
        $validate = [
            'title' => "required| string",
            'description' => "required|string",
            'price' => "required",
            'attribute.*'=>'required',
        ];
        if ($id) {
            return $validate;
        }
        return array_merge($validate, [
            'district_id' => 'required',
            'ward_id' => "required",
            'customer_id' => "required",
            'category_id' => "required",
            'time' => 'required',
            'addressDetails'=>"required",
            ]);
    }

    public function messages()
    {
        return [
            'title.required' => 'Nhập tiêu đề',
            'description.required' => 'Nhập mô tả',
            'price.required' => 'Nhập giá',
            'district_id.required' => 'Chọn quận huyện',
            'ward_id.required' => 'Chọn xã phường',
            'addressDetails.required'=>'Nhập địa chỉ chi tiết',
            'category_id.required' => 'Chọn danh mục',
            'customer_id.required' => "Chọn người thuê",
            'time.required' => "Chọn thời gian bắt đầu",
            'attributes.*.required' => "Thuộc tính không được bỏ trống",

        ];
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'post_attribute', 'post_id', 'attribute_id')->withPivot('value');
    }

    public function createData($data)
    {
        if (isset($data['employee_id'])){
            $data['status']=Post::TimDuocNGV;
            $employee=Employee::find($data['employee_id']);
            $employee->status=Employee::ChoXacNhan;
            $employee->save();
        }
        $data = array_filter($data);
        $this->fill($data)->save();
        if (isset($data['attributes'])){
            $attribute = $data['attributes'];
            foreach ($attribute as $key => $value) {
                $value = json_encode($value);
                $this->attributes()->attach($key, ['value' => $value]);
            }
        }
    }

    public function updateData($data, $id)
    {
        if (isset($data['attributes'])) {
            $attribute = $data['attributes'];
            foreach ($attribute as $key => $value) {
                $value = json_encode($value);
                $attr[$key] = ['value' => $value];
            }
            $this->find($id)->attributes()->sync($attr);
        }else{
            $this->find($id)->attributes()->detach();
        }
        $data['status'] = Post::ChoDuyet;
        $data = array_filter($data);

        $this->find($id)->fill($data)->save();
    }

    public function updateStatus($data, $id)
    {
        $data = array_filter($data);
        if (isset($data['employee_id'])) {
            $data['status'] = Post::TimDuocNGV;

        } else {
            if (isset($data['statusPost'])) {
                $data['status'] = $data['statusPost'];
                $data['employee_id'] = null;
            } else {
                $data['status'] = Post::DaHuy;
            }
        }
        $this->find($id)->fill($data)->update();
    }
}
