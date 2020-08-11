<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'devvn_xaphuongthitran';
    protected $fillable = ['xaid','name','type','maqh'];
    public function district(){
        return $this->hasOne("\App\Models\District", 'maqh', 'maqh');
    }
}
