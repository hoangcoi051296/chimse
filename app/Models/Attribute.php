<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attribute';
    protected $fillable = ['name','category_id','type', 'options'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function rules($id=null){
        return [
            'name' => "required| string| max:255|unique:attribute,name,".$id,
            'option.*'=>'required|min:1',
        ];
    }
    public function saveData($data){
        if (isset($data['key']) &&isset($data['value'])){
            $data['options']= json_encode(array_combine($data['key'],$data['value']));
        }
        return $this->fill($data)->save();
    }
    public function updateData($data,$id){
        if (isset($data['key']) &&isset($data['value'])){
            $data['options']= json_encode(array_combine($data['key'],$data['value']));
        }
        return $this->find($id)->fill($data)->save();
    }
}
