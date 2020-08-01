<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('helper.auth.login');
    }
    public function postLogin(Request $request)
    {

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);
        // kiểm tra thông tin đăng nhập
        if (Auth::guard('helper')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->route('helper.index');
        }
        return redirect()->route('helper.login')->with("error", "The account or password is incorrect!")->withInput();
    }
    public function register(){
        return view('helper.auth.register');
    }
}
