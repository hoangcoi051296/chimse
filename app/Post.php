<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = ['title', 'status', 'description', 'price', 'address', 'category_id','helper_id',	'customer_id'];


    public function getData($request = null)
    {
        $data = $this->query();
        if($request['customer_id']){
            $data->where('customer_id',$request['customer_id']);
        }
        if ($request->get('search')) {
           $search = $request->get('search');
           $data->where('title','LIKE','%'.$search.'%')
            ->orWhere('price','LIKE','%'.$search.'%')
            ->orWhere('description','LIKE','%'.$search.'%')
            ->orWhere('address','LIKE','%'.$search.'%');
        }
        $data = $data->paginate($request->get('per_page', 15));
        return $data;
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
