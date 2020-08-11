<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['title', 'status', 'description', 'price', 'address', 'category_id', 'helper_id', 'customer_id'];

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
        $posts=$this->query()->orderBy('created_at','desc');
        if (!$condition){
            return $posts;
        }
        if (isset($condition['status'])) {
            $posts=$posts->where('status', $condition['status']);
        }
        if (isset($condition['address'])) {
            $posts=$posts->where('address', $condition['address']);
        }
        $data = $this->query();
        if ($condition['customer_id']) {
            $data->where('customer_id', $condition['customer_id']);
        }
        if (isset($condition['search'])) {
            $search = $condition['search'];
            $posts = $posts->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', '%' . $search . '%')
                    ->orwhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('Address', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
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
        $data = $data->paginate($condition->get('per_page', 15));
        return $data;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'helper_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    public function rating()
    {
        return $this->hasMany(Feedback::class, 'post_id', 'id');
    }


    public function avgRate()
    {
        return $this->rating()->avg('rating');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'matp');
    }


    public function getAddress()
    {
        return $this->belongsTo(Address::class, 'address', 'maqh');
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'commune_id', 'xaid');
    }

//    public function getFullAddressAttribute()
//    {
//        return "{$this->district->name} {$this->ward->name}";
//    }


    public function findDistrict($id)
    {
        return Address_QuanHuyen::where('maqh', $id)->first();
    }

    public function findWard($id)
    {
        return Address_XaPhuong::where('xaid', $id)->first();
    }

    public function rules($id = null)
    {
        $validate = [
            'title' => "required| string| max:255",
            'description' => "required|string|max:255",
            'price' => "required",
            'category_id' => "required",
            'customer_id' => "required",
        ];
        if ($id) {
            return $validate;
        }
        return array_merge($validate, ['district' => 'required',
            'ward' => "required"]);

    }

    public function createData($data)
    {
        $data['address'] = json_encode([
            'district' => $data['district'],
            'ward' => $data['ward'],
        ]);
        $data = array_filter($data);
        return $this->fill($data)->save();
    }

    public function updateData($data, $id)
    {
        if ($data['district'] && $data['ward']) {
            $data['address'] = json_encode([
                'district' => $data['district'],
                'ward' => $data['ward'],
            ]);
        }
        $data = array_filter($data);
        $this->find($id)->fill($data)->save();
    }

}
