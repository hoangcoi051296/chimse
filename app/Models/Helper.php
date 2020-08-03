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

class Helper extends Model implements Authenticatable
{
    use AuthenticableTrait;
    protected $table = 'helper';
    protected $fillable = ['id','name','email','phone','password','address'];
    protected $hidden = [
        'password', 'remember_token',
    ];
//    public function getAddress($id){
//        return DB::table('devvn_quanhuyen')->where('maqh',$id)->first()->name;
//    }
    public function getData($condition ,$request){
        $helpers=$this->query() ;
        if (!$condition){
            return $helpers;
        }
        if (isset($condition['address'])) {
            $helpers=$helpers->where('address', $condition['address']);
        }
        if (isset($condition['search'])) {
            $search=$condition['search'];
            $helpers=$helpers->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('Address', function ($query) use ($search) {
                        $query->where('name','like', '%'. $search.'%' );
                    });
            });
        }
        return $helpers;
    }
    public function Address(){
        return $this->hasOne("\App\Models\Address",'maqh','address');
    }
    public function rules($id=null)
    {
        $validate=[
            'name' => "required| string| max:255",
            'email' => "required|string|email|regex:^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$^|unique:helper,email,".$id,
            'phone'=>'required|unique:helper,phone,'.$id,
            'address'=>'required',
        ];
        if (!$id){
            return Arr::add( $validate,'password','required|min:6|confirmed') ;
        }
        return Arr::add($validate,'password','sometimes|nullable|min:6|confirmed') ;
    }
    public $perPage = 10;
    public function createData($request){
        $data =$request->all();
        $data['password']=bcrypt($request->password);
//        return $this->fill($data)->save();
        if ($this->fill($data)->save()){
            Mail::to($data['email'])->send(new AccountCreated());
            return true;
        }
        return false;
    }
    public function updateData($request,$id){
        $data =$request->all();
        if (!$request->password) {
            return
            $this->find($id)->fill(['name'=>$request->name,'email'=>$request->email])->save();
        }
        $data['password']=bcrypt($request->password);
        $this->find($id)->fill($data)->save();
    }
    public function deleteData($id){
        $this->find($id)->delete();
    }

}
