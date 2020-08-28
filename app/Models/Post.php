<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['title', 'status', 'description', 'price', 'district_id', 'ward_id','addressDetails', 'category_id', 'employee_id', 'customer_id', 'time_start','time_end'];
    const PerPage = 10;

    public function getData($condition)
    {
        $posts = $this->query()->orderBy('created_at', 'desc');
        if (!$condition) {
            return $posts->paginate($this->perPage);
        }
        $posts
            ->time($condition)
            ->status($condition)
            ->category($condition)
            ->district($condition)
            ->ward($condition)
            ->search($condition)
            ->customer($condition)
        ;
        return $posts->paginate(isset($condition['per_page']) ? $condition['per_page'] : $this->perPage);
    }

    public function scopeStatus($posts,$condition){
        if (isset($condition['status']) && $condition['status'] !== null) {
            $posts = $posts->where('status', $condition['status']);
        }
    }
    public function scopeCategory($posts,$condition){
        if (isset($condition['category'])) {
            $posts = $posts->where('category_id', $condition['category']);
        }
    }
    public function scopeDistrict($posts,$condition){
        if (isset($condition['district']) && $condition['district'] !== null) {
            $posts = $posts->where('district_id', $condition['district']);
        }
    }
    public function scopeWard($posts,$condition){
        if (isset($condition['ward']) && $condition['ward'] !== null) {
            $posts = $posts->where('ward_id', $condition['ward']);
        }
    }
    public function scopeCustomer($posts,$condition){
        if (isset($condition['customer_id']) && $condition['customer_id'] !== null) {
            $posts->where('customer_id', $condition['customer_id']);
        }
    }
    public function scopeTime($posts,$condition){
        if (isset($condition['startTime']) && isset($condition['finishTime'])){
            $posts->whereDate('created_at','>=',$condition['startTime'])->whereDate('updated_at','<=',$condition['finishTime']);
        }
    }
    public function scopeSearch($posts,$condition){
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

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'post_attribute', 'post_id', 'attribute_id')->withPivot('value');
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
        $now =Carbon::now();
        $oneMonthFromNow = $now->addMonth(1);

        $validate = [
            'title' => "required| string",
            'description' => "required|string",
            'price' => "required",
            'time_start' => 'required|before:time_end|after:tomorrow',
            'time_end' => 'before:'.$oneMonthFromNow,
        ];
        if ($id) {
            return $validate;
        }
        return array_merge($validate, [
            'district_id' => 'required',
            'ward_id' => "required",
            'category_id' => "required",
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
            'time_start.required' => "Chọn thời gian bắt đầu",
            'attributes.*.required' => "Thuộc tính không được bỏ trống",
            'time_start.before' => "Thời gian bắt đầu phải trước thời gian kết thúc",
            'time_start.after'=>"Thời gian bắt đầu công việc từ ngày mai",
            'time_end.before'=>"Đăng bài trong vòng 1 tháng"

        ];
    }


    public function createData($data)
    {

        if (isset($data['employee_id'])){
            $data['status']=3;
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
        $data['status'] = 1;
        $data = array_filter($data);

        $this->find($id)->fill($data)->save();
    }

    public function updateStatus($data, $id)
    {
        $data = array_filter($data);
        if (isset($data['employee_id'])) {
            $data['status'] = 3;

        } else {
            if (isset($data['statusPost'])) {
                $data['status'] = $data['statusPost'];
                $data['employee_id'] = null;
                return   $this->find($id)->fill($data)->update();
            }elseif(isset($data['status'])){
                $data['status']=$data['status'];
                return    $this->find($id)->fill($data)->update();
            } else {
                $data['status'] = 0;
                return $this->find($id)->fill($data)->update();
            }
        }
        $this->find($id)->fill($data)->update();
    }

}