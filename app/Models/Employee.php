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
    protected $fillable = ['name', 'email', 'phone', 'password', 'district_id','ward_id'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    const ChoViec =0 ;
    const XacNhanCV = 1;
    const BatDau = 2;
    const HoanThanh = 3;
    public function getData($condition)
    {
        $helpers = $this->query()->orderBy('created_at', 'desc');
        if (!$condition) {
            return $helpers;
        }
            if (isset($condition['district'])) {
            $districtFilter =$condition['district'];
            $helpers->WhereHas('district', function ($query) use ($districtFilter) {
                $query->where('maqh',$districtFilter);
            });
        }
            if (isset($condition['ward'])) {
                $wardFilter =$condition['ward'];
                $helpers->WhereHas('ward', function ($query) use ($wardFilter) {
                    $query->
                       where('xaid',$wardFilter);
                });
            }
            if (isset($condition['search'])) {
            $search = $condition['search'];
           $helpers->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('ward', function ($query) use ($search) {
                        $query->whereHas('district',function ($q)use($search){
                            $q->where('name','like','%'.$search.'%');
                        });
                    });
            });
        }
        return $helpers;
    }

    public function ward()
    {
        return $this->hasOne("\App\Models\Ward", 'xaid', 'ward_id');
    }
    public function district()
    {
        return $this->hasOne(District::class, 'maqh', 'district_id');
    }
    public function rules($id = null)
    {
        $validate = [
            'name' => "required| string| max:255",
            'phone' => 'required|unique:employee,phone,' . $id,
            'ward' => 'required',
            'district'=>'required',
        ];
        if (!$id) {
           return array_merge($validate,[
                'email' => "required|string|email|regex:^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$^|unique:employee,email," . $id,
               'password'=> 'required|min:6|confirmed'
            ]);
        }
        return Arr::add($validate,  'password', 'sometimes|nullable|min:6|confirmed');

    }
    public function messages()
    {
        return [
            'name.required' => 'Nhập tên tài khoản',
            'phone.required' => 'Nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'email.required' => 'Nhập địa chỉ email',
            'email.unique'=>'Email đã tồn tại',
            'email.regex' => 'Email không đúng định dạng',
            'district.required' => 'Chọn quận huyện',
            'ward.required' => 'Chọn xã phường',
            'password.required' => 'Nhập mật khẩu',
            'password.confirmed'=>"Xác nhận mật khẩu không khớp",
        ];
    }

    public $perPage = 10;

    public function createData($data)
    {
        $data['password'] = bcrypt($data['password']);
        $data['district_id']=$data['district'];
        $data['ward_id']=$data['ward'];
        return $this->fill($data)->save();
    }

    public function updateData($data, $id)
    {
        $data['phone'] = format_phone_number($data['phone']);
        $data = array_filter($data);
        $data['district_id']=$data['district'];
        $data['ward_id']=$data['ward'];
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
