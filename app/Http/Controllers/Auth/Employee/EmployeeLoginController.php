<?php

namespace App\Http\Controllers\Auth\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLoginController extends Controller
{
    public function login(){
        return view('employee.auth.login');
    }
    public function postLogin(Request $request)
    {

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);
        // kiểm tra thông tin đăng nhập
        if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->route('employee.index');
        }
        return redirect()->route('employee.login')->with("error", "The account or password is incorrect!")->withInput();
    }
}
