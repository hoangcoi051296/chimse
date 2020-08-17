<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['title', 'status', 'description','attributes', 'price', 'district_id','ward_id', 'category_id', 'helper_id', 'customer_id'];

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
            $search=$condition['search'];
            $posts=$posts->where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                    ->orwhere('description','LIKE', '%' . $search . '%')
                    ->orWhereHas('ward', function ($query) use ($search) {
                        $query->whereHas('district',function ($q)use($search){
                            $q->where('name','like','%'.$search.'%');
                        });
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

    public function ward()
    {
        return $this->hasOne("\App\Models\Ward", 'xaid', 'ward_id');
    }
    public function district()
    {
        return $this->hasOne(District::class, 'maqh', 'district_id');
    }
    public function rules($id=null){
        $validate=[
            'title' => "required|string|max:255",
            'price'=>"required",
            'district'=>'required',
            'ward'=>"required",
            'customer_id'=>"required",
        ];
        if(!$id){
            return array_merge($validate,[ 'description'=>"required",'category_id'=>"required"]) ;
        }
        return $validate;

    }
    public function createData($data){
        $data=array_filter($data);
        $data['district_id']=$data['district'];
        $data['ward_id']=$data['ward'];
        $data['attributes']= json_encode($data['attributes']);
        return $this->fill($data)->save();
    }
    public function updateData($data,$id){
        if ($data['district'] && $data['ward']){
            $data['address']=$data['ward'];
        }
        $data['status']=Post::ChoDuyet;
        $data=array_filter($data);
        $data['district_id']=$data['district'];
        $data['ward_id']=$data['ward'];
        $data['attributes']= json_encode($data['attributes']);
        $this->find($id)->fill($data)->save();
    }
}
