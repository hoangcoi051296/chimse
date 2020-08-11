<?php

namespace App\Models;

use App\Mail\AccountCreated;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Helper\Table;

class Employee extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $table = 'employee';
    protected $fillable = ['name', 'email', 'phone', 'password', 'address'];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getData($condition, $request)
    {
        $helpers = $this->query()->orderBy('created_at', 'desc');
        if (!$condition) {
            return $helpers;
        }
        if (isset($condition['address'])) {
            $helpers->where('address', $condition['address']);
        }
        if (isset($condition['search'])) {
            $search = $condition['search'];
           $helpers->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('Ward', function ($query) use ($search) {
                        $query->whereHas('District',function ($q)use($search){
                            $q->where('name','like','%'.$search.'%');
                        });
                    });
            });
        }
        return $helpers;
    }

    public function Ward()
    {
        return $this->hasOne("\App\Models\Ward", 'xaid', 'address');
    }
    public function rules($id = null)
    {
        $validate = [
            'name' => "required| string| max:255",
            'email' => "required|string|email|regex:^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$^|unique:employee,email," . $id,
            'phone' => 'required|unique:employee,phone,' . $id,
            'ward' => 'required',
        ];
        if (!$id) {
            return Arr::add($validate, 'password', 'required|min:6|confirmed');
        }
        return Arr::add($validate, 'password', 'sometimes|nullable|min:6|confirmed');
    }

    public $perPage = 10;

    public function createData($data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->fill($data)->save();
    }

    public function updateData($data, $id)
    {
        $data['phone'] = format_phone_number($data['phone']);
        $data['address']=$data['ward'];
        $data = array_filter($data);
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        $this->find($id)->fill($data)->save();
    }

    public function deleteData($id)
    {
        $this->find($id)->delete();
    }


}
