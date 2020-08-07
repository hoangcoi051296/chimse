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

            return redirect()->route('customer.index');

        } else {
            //sai thông báo lỗi
//            dd("Loiix");
            return redirect('customer/login')->with("error", "The account or password is incorrect!")->withInput();
        }
    }
}
