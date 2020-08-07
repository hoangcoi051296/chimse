<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address_QuanHuyen extends Model
{
    protected $table = 'devvn_quanhuyen';
    protected $fillable = ['maqh','name','type'];
}
