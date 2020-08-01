<?php

namespace App\Http\Controllers\Customer;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.index');
    }
    public function getLogin()
    {
        // trả về trang đăng nhập
        return view('customer.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);
        // kiểm tra thông tin đăng nhập
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
//            dd('dang nhap thanh cong');
            return redirect()->route('customer.index');
        } else {
            //sai thông báo lỗi
            dd("Loiix");
            return redirect('admin/login')->with("thongbao", "The account or password is incorrect!")->withInput();
        }
    }
    public function getRegister()
    {
        // trả về trang đăng nhập
        return view('customer.register');
    }
    public function postRegister(Request $request)
    {
        $data = $request->all();
        $rules = [
            'email'   => 'required|email',
            'password' => 'required',
            'name' => 'required'
        ];
        $validator = \Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $data['password'] = bcrypt($data['password']);
        $user = Customer::create($data);
        return redirect()->route('login');

    }
}
