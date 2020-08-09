<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = ['post_id','province_id', 'district_id', 'commune_id', 'note'];

    public function posts()
    {
        return $this->hasMany(Post::class,'province_id', 'id', 'district_id', 'id', 'commune_id', 'id');
    }
}
