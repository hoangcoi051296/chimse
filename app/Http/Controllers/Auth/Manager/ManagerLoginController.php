<?php

namespace App\Http\Controllers\Auth\Manager;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerLoginController extends Controller
{
    public function login(){
        return view('manager.auth.login');
    }
    public function postLogin(Request $request)
    {

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);
        // kiểm tra thông tin đăng nhập
        if (Auth::guard('manager')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
           return redirect()->route('manager.index');
        }
            return redirect()->route('manager.login')->with("error", "The account or password is incorrect!")->withInput();
        }
}
