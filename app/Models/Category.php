<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['name'];


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
    public function attributes(){
        return $this->hasMany(Attribute::class,'category_id','id');
    }
    public  function rules($id=null){
            return [
                'name'=>'required|unique:category,name,'.$id,
            ];
    }
    public  function message(){
        return [
          'name.required'=>'Nhập tên danh mục',
          'name.unique'=>'Danh mục đã tồn tại',
        ];
    }
    public function createData($data){
       return $this->fill($data)->save();
    }

    public function updateData($data,$id){
        return $this->find($id)->fill($data)->save();
    }
}
