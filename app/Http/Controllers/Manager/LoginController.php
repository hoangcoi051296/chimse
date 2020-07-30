<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('manager.auth.login');
    }
    public function postLogin(Request $request)
    {

        //lấy thông tin email và mật khẩu của người dùng
        $credentials = $request->only('email', 'password');
        // kiểm tra thông tin đăng nhập
        $checkLogin = Auth::guard('manager')->attempt($credentials);
        // kiểm tra điều kiên
        if ($checkLogin) {
            // đúng đăng nhập thành công
            return redirect()->route('manager.login');
        } else {
            //sai thông báo lỗi
            return redirect()->route('manager.test')->with("success", "The account or password is incorrect!")->withInput();
        }}
}
