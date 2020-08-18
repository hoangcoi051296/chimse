<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['title', 'status', 'description', 'price', 'district_id', 'ward_id', 'category_id', 'helper_id', 'customer_id', 'time'];
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

        if ($condition['status'] !== null) {
            $posts = $posts->where('status', $condition['status']);
        }
        if ($condition['time'] !== null) {
            $posts = $posts->where('time', $condition['time']);
        }
        if ($condition['district'] !== null) {
            $posts = $posts->where('district_id', $condition['district']);
        }
        if ($condition['ward'] !== null) {
            $posts = $posts->where('ward_id', $condition['ward']);
        }
        if ($condition['search'] !== null) {
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
        if ($condition['customer_id'] !== null)
        {
            $posts->where('customer_id', $condition['customer_id']);
        }
        return $posts->paginate(10);
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

    public function rules()
    {
        $validate = [
            'title' => "required",
            'description' => "required",
            'price' => "required",
            'category_id' => "required",
//            'customer_id' => "required",
        ];
        return array_merge($validate, ['district' => 'required',
            'ward' => "required"]);

    }

    public function createData($data)
    {
        $data['time'] = date('Y-m-d H:i:s', strtotime($data['time']));
        $data['ward_id'] = $data['ward'];
        $data['district_id'] = $data['district'];
        $data = array_filter($data);
        return $this->fill($data)->save();
    }

    public function updateData($data, $id)
    {
        if ($data['district'] && $data['ward']) {
            $data['address'] = $data['ward'];
        }

        $data['status'] = Post::ChoDuyet;
        $data = array_filter($data);
        $data['district_id'] = $data['district'];
        $data['ward_id'] = $data['ward'];
        $data['attributes'] = json_encode($data['attributes']);
        $data['status'] = Post::ChoDuyet;
        $data = array_filter($data);
        $this->find($id)->fill($data)->save();
    }
}
