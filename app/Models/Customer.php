<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model implements Authenticatable

{
    use AuthenticableTrait;
    protected $table = 'customer';
    protected $fillable = ['name','email','phone','district_id','ward_id','password','is_active'];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function data($request = null){
        $data = $this->query();
        if ($request->get('search')) {
            $search = $request->get('search');
            $data->where('name','LIKE','%'.$search.'%')
             ->orWhere('email','LIKE','%'.$search.'%')
             ->orWhere('phone','LIKE','%'.$search.'%');
         }
        $data = $data->paginate($request->get('per_page',15));
        return $data;
    }

    public function posts()
    {
        return $this->hasMany(Post::class,'customer_id','id');
    }

    public function getAddress()
    {
        return $this->belongsTo(District::class,'address','maqh');
    }
}
