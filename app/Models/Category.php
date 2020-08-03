<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['name', 'properties'];


    public function data($request = null){
        $data = $this->query();

        $data = $data->paginate($request->get('per_page',15));
        return $data;
    }

    public function properties()
    {
        $data = array();
//        foreach (explode(',',$this->properties) as $pro){
//
//        }
    }
}
