<?php

namespace App\Models;
use http\Env\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;

class Helper extends Model implements Authenticatable
{
    use AuthenticableTrait;
    protected $table = 'helper';
    protected $fillable = ['name','email','password'];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $perPage = 15;
    public function data($request){
        $data =$request->all();
        if ($request->password){
            $data['password']=bcrypt($request->password);
        }
        return $data;
    }
    public function create(){

    }
    public function store(){
//        return
    }
}
