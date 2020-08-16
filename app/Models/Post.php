<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['title', 'status', 'description', 'price', 'address', 'category_id', 'helper_id', 'customer_id', 'time'];

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
            $posts->where('status', $condition['status']);
        }
        if (isset($condition['address'])) {
            $posts->where('address', $condition['address']);
        }
        if (isset($condition['time'])){
//            $posts->whereBetween('date')
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
        return $this->hasOne("\App\Models\Ward", 'xaid', 'address');
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
            'title' => "required| string| max:255",
            'description' => "required|string|max:255",
            'price' => "required",
            'category_id' => "required",
//            'customer_id' => "required",
        ];
        if ($id) {
            return $validate;
        }
        return array_merge($validate, ['district' => 'required',
            'ward' => "required"]);

    }

    public function createData($data)
    {
        $data['time'] = json_encode($data['time']);
        $data['address'] = $data['ward'];
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
        $this->find($id)->fill($data)->save();
    }
}