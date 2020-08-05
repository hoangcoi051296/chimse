<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPassword;
use App\Models\Activation;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function getForget(){
        return view('customer.forgot');
    }
    public function postForget(Request $request){
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $checkEmail = Customer::where('email',$request->get('email'))->first();
        if(!$checkEmail){
            return redirect()->back()->with("error", "Email khong ton tai")->withInput();
        }
        if ($checkEmail->is_active == 0){
            return redirect()->back()->with("error", "Tai khoan nay chua duoc active, xem lai mail")->withInput();
        }
        $code = Activation::where('user_id',$checkEmail->id)
        ->where('type','customer')->first()->token;
        Mail::to($checkEmail->email)->send(new ForgetPassword($checkEmail,$code));
        return redirect()->route('customer.login');
    }

    public function getForgetComplete($id,$code)
    {
        $check = Activation::where('user_id',$id)
            ->where('token',$code)
            ->first();
        if(!$check){
            return redirect()->route('customer.login')->with("error", "Code ko dung")->withInput();
        }
        return view('customer.resetpass',compact('check'));
    }

    public function resetPass($id,Request $request)
    {
        $customer = Customer::find($id);
        $this->validate($request, [
            'password' => 'required'
        ]);
        $customer->password = bcrypt($request->get('password'));
        $customer->save();

        return redirect()->route('customer.login');

    }
}
