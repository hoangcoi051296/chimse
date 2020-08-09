<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $table = 'devvn_xaphuongthitran';
    protected $fillable = ['xaid','name','type','maqh'];
}
