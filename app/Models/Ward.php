<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address_XaPhuong extends Model
{
    protected $table = 'devvn_xaphuongthitran';
    protected $fillable = ['xaid','name','type','maqh'];
}
