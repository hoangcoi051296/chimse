<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;
use  Illuminate\Foundation\Auth\Access\Authorizable;

class Manager extends Model implements Authenticatable

{
    use Authorizable;
    use AuthenticableTrait;
    protected $table = 'managers';
    protected $fillable = ['name','email','password','avatar'];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getData($conditions = null){

    }

    public function create(){

    }

//    public function update(){
//
//    }
    public function delete(){

    }

}
