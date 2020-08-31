<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['name'];


    public function data($condition){
        $data = $this->query();
        if (isset($condition['create_from']) && isset($condition['create_to'])) {
            $data->whereDate('created_at', '>=', $condition['create_from'])->whereDate('created_at', '<=',
                $condition['create_to']);
        }elseif (isset($condition['create_from'])) {
            $data->whereDate('created_at', '>=', $condition['create_from']);
        }
        elseif (isset($condition['create_to'])) {
            $data->whereDate('created_at', '<=', $condition['create_to']);
        }
        if(isset($condition['search'])){
            $data->where('name','like','%'.$condition['search'].'%');
        }
        $data = $data->paginate(15);
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
