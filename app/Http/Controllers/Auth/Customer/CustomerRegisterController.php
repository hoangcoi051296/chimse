<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomerRegisterController extends Controller
{
    public function getRegister()
    {
        // trả về trang đăng nhập
        return view('customer.register');
    }

    public function postRegister(Request $request)
    {
        $data = $request->all();
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required'
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $data['password'] = bcrypt($data['password']);
        $user = Customer::create($data);
        Mail::to($user->email)->send(new SendMail());
        return redirect()->route('login');

    }
}
