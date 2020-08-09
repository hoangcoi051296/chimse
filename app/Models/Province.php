<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'devvn_tinhthanhpho';
    protected $fillable = ['matp','name','type'];

    public function districts()
    {
        return $this->hasMany(District::class,'matp','maqh');
    }
}
