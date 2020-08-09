<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['title', 'status', 'description', 'price', 'address', 'category_id', 'helper_id', 'customer_id','province_id','district_id','commune_id'];

    const DaHuy =0;
    const ChoDuyet=1;
    const DaDuyet=2;
    const TimDuocNGV=3;
    const NGVXacNhanCV=4;
    const NGVBatDau=5;
    const NGVKetThuc=6;
    const NTXacNhan=7;
    public function getData($request = null)
    {
        $data = $this->query();
        if ($request['customer_id']) {
            $data->where('customer_id', $request['customer_id']);
        }
        if ($request->get('search')) {
            $search = $request->get('search');
            $data->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('price', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%')
                ->orWhere('address', 'LIKE', '%' . $search . '%');
        }
        if ($request->get('province')){
            $data->where('province_id', $request->get('province'));
        }
        if ($request->get('district')){
            $data->where('district_id', $request->get('district'));
        }
        $data = $data->paginate($request->get('per_page', 15));
        return $data;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

//    public function getAddress()
//    {
//        return $this->belongsTo(Address::class,'address','maqh');
//    }

    public function rating()
    {
        return $this->hasMany(Feedback::class,'post_id','id');
    }

    public function avgRate()
    {
        return $this->rating()->avg('rating');
    }

    public function province()
    {
        return $this->belongsTo(Province::class,'province_id','matp');
    }
    public function district()
    {
        return $this->belongsTo(District::class,'district_id','maqh');
    }
    public function commune()
    {
        return $this->belongsTo(Commune::class,'commune_id','xaid');
    }

    public function getFullAddressAttribute()
    {
        return "{$this->province->name} {$this->district->name} {$this->commune->name}";
    }

}
