<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['title', 'status', 'description', 'price', 'district_id','ward_id', 'category_id', 'helper_id', 'customer_id','time'];
    const DaHuy = 0;
    const ChoDuyet = 1;
    const DaDuyet = 2;
    const TimDuocNGV = 3;
    const NGVXacNhanCV = 4;
    const NGVBatDau = 5;
    const NGVKetThuc = 6;
    const NTXacNhan = 7;

    public function getData($condition)
    {
        $posts = $this->query()->orderBy('created_at', 'desc');
        if (!$condition) {
            return $posts;
        }
        if (isset($condition['status'])) {

            $posts= $posts->where('status', $condition['status']);
        }
        if (isset($condition['district'])) {
            $filter=$condition['district'];
            $posts= $posts->whereHas('ward',function ($q) use ($filter){
                $q->whereHas('district',function ($q)use($filter){
                    $q->where('maqh',$filter);
                });
            });
        }
        if (isset($condition['ward'])) {
            $posts= $posts->where('ward_id', $condition['ward']);
        }
        if (isset($condition['search'])) {
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
        return $posts;
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
            'attributes.*'=>'required',
            'time'=>'required',
//            'customer_id' => "required",
        ];
        if ($id) {
            return $validate;
        }
        return array_merge($validate, ['district' => 'required',
            'ward' => "required", 'customer_id' => "required",'category_id' => "required"]);

    }
    public function messages()
    {
        return [
            'title.required' => 'Nhập tiêu đề',
            'description.required' => 'Nhập mô tả',
            'price.required' => 'Nhập giá',
            'district.required' => 'Chọn quận huyện',
            'ward.required' => 'Chọn xã phường',
            'category_id.required' => 'Chọn danh mục',
            'customer_id.required'=>"Chọn người thuê",
            'time.required'=>"Chọn thời gian bắt đầu",
            'attributes.*.required'=>"Thuộc tính không được bỏ trống",

        ];
    }
    public function attributes(){
        return $this->belongsToMany(Attribute::class,'post_attribute','post_id','attribute_id')->withPivot('value');
    }
    public function createData($data)
    {
        $attribute=$data['attributes'];
//        $data['time'] = json_encode($data['time']);
        $data['district_id']=$data['district'];
        $data['ward_id']=$data['ward'];
        $data = array_filter($data);
        $this->fill($data)->save();
        foreach ($attribute as $key => $value) {
            $value = json_encode($value);
            $this->attributes()->attach($key, ['value' => $value]);
        }
    }
    public function updateData($data, $id)
    {
        $attribute=$data['attributes'];
        $data['status']=Post::ChoDuyet;
        $data=array_filter($data);
        $data['district_id']=$data['district'];
        $data['ward_id']=$data['ward'];
        foreach ($attribute as $key => $value) {
            $value = json_encode($value);
            $attr[$key] = ['value' => $value];
        }
        $this->find($id)->attributes()->sync($attr);
        $data = array_filter($data);

        $this->find($id)->fill($data)->save();
    }
}
