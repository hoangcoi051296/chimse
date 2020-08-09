<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'devvn_quanhuyen';
    protected $fillable = ['maqh','name','type','matp'];

    public function communes()
    {
        return $this->hasMany(Commune::class,'maqh','xaid');
    }
}
