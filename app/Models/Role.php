<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $fillable = [
        'name','id'
    ];
    const PerPage = 10;
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'role_permission','role_id','permission_id')->withTimestamps();
    }
    public function getData($condition){
        $role=$this->query($condition);
        return $role->paginate(self::PerPage);
    }
    public function rules($id=null){
        return[
            'name' => "required| string| max:255|unique:role,name,".$id,
        ];
    }
    public function message(){
        return[
            'name.required'=>'Nhập tên  ',
            'name.unique' =>'Tên đã tồn tại'
        ];
    }
    public function createData($data){
        $this->fill($data)->save();
        $this->permissions()->sync($data['permission_id']);
    }

    public function updateData($data,$id){
        $this->find($id)->fill($data)->save();
        $this->find($id)->permissions()->sync($data['permission_id']);
    }
}
