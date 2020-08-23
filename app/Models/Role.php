<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $fillable = [
        'name','id'
    ];
    public function permissions()
    {
        return $this->belongsToMany("\App\Permission",'role_permission','role_id','permission_id')->withTimestamps();
    }
}
