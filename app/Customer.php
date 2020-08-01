<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model implements Authenticatable

{
    use AuthenticableTrait;
    protected $table = 'customer';
    protected $fillable = ['name','email','password','phone'];
    protected $hidden = [
        'password', 'remember_token',
    ];
}