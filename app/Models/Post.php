<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['title', 'status', 'description', 'price', 'address', 'category_id', 'helper_id', 'customer_id'];

    const DaHuy =0;
    const ChoDuyet=1;
    const DaDuyet=2;
    const TimDuocNGV=3;
    const NGVXacNhanCV=4;
    const NGVBatDau=5;
    const NGVKetThuc=6;
    const NTXacNhan=7;

    public function getData($condition){
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
        if (isset($condition['search'])) {
            $search=$condition['search'];
            $posts=$posts->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', '%' . $search . '%')
                    ->orwhere('description','LIKE', '%' . $search . '%')
                    ->orWhereHas('Address', function ($query) use ($search) {
                        $query->where('name','like', '%'. $search.'%' );
                    })
                    ->orWhereHas('customer', function ($query) use ($search) {
                    $query->where('name','like', '%'. $search.'%' );
                    })
                    ->orWhereHas('employee', function ($query) use ($search) {
                    $query->where('name','like', '%'. $search.'%' );
                    })
                    ->orWhereHas('category', function ($query) use ($search) {
                    $query->where('name','like', '%'. $search.'%' );
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

    public function Address(){
        return $this->hasOne("\App\Models\Address_QuanHuyen",'maqh','address');
    }

    public function findDistrict($id){
       return Address_QuanHuyen::where('maqh',$id)->first();
    }
    public function findWard($id){
        return Address_XaPhuong::where('xaid',$id)->first();
    }

    public function rules($id=null){
        $validate=[
            'title' => "required| string| max:255",
            'description'=>"required|string|max:255",
            'price'=>"required",
            'category_id'=>"required",
            'customer_id'=>"required",
        ];
        if($id){
            return $validate;
        }
        return array_merge($validate,['district'=>'required',
            'ward'=>"required"]) ;

    }
    public function createData($data){
        $data['address']=json_encode([
            'district'=>$data['district'],
            'ward'=>$data['ward'],
        ]) ;
        $data=array_filter($data);
        return $this->fill($data)->save();
    }
    public function updateData($data,$id){
        if ($data['district'] && $data['ward']){
            $data['address']=json_encode([
                'district'=>$data['district'],
                'ward'=>$data['ward'],
            ]) ;
        }
        $data=array_filter($data);
        $this->find($id)->fill($data)->save();
    }
}
