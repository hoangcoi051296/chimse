<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreated;
use App\Models\Activation;
use App\Models\Address_QuanHuyen;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomerRegisterController extends Controller
{
    protected $active;
    public function __construct(Activation $active){
        $this->active = $active;
    }
    public function getRegister()
    {
        $address = Address_QuanHuyen::where('matp', 01)->get();
        // trả về trang đăng nhập
        return view('customer.register',compact('address'));
    }

    public function postRegister(Request $request)
    {
        $data = $request->all();
        $rules = [
            'email' => 'required|email|unique:customer',
            'password' => 'required',
            'name' => 'required',
            'address' => 'required'
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->with("error", $validator->errors())->withInput();
        }
        $data['password'] = bcrypt($data['password']);
        $user = Customer::create($data);
        $user->type = 'customer';
        $activation = $this->active->createToken($user);
        Mail::to($user->email)->send(new AccountCreated($user,$activation));
        return redirect()->route('customer.login');

    }

    public function activeAccount($id,$token)
    {
        $check = $this->active->where('user_id',$id)
            ->where('token',$token)
            ->first();
        if($check){
            $user = Customer::find($id);
            $user->is_active = 1;
            $user->save();
            return redirect()->route('customer.index');
        }
    }
}
