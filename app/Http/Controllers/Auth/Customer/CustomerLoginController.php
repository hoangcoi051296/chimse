<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    public function getLogin()
    {
        return view('customer.auth.login');
    }
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::guard('customer')->user()->is_active == 0){
                return redirect('customer/login')->with("error", "tai khoan chua active vui long check lai mail!")->withInput();
            }
            return redirect()->route('customer.index');
        } else {
            return redirect('customer/login')->with("error", "The account or password is incorrect!")->withInput();
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('customer.login');
    }
}