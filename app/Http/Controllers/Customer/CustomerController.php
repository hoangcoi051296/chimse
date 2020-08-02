<?php

namespace App\Http\Controllers\Customer;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use PhpParser\Node\Expr\PostDec;

class CustomerController extends Controller
{
    protected $customer;
    protected $post;
    public function __construct(Customer $customer,Post $post)
    {
        $this->customer = $customer;
        $this->post = $post;
    }

    public function index(Request $request)
    {

// Mail::to("dongoclam711@gmail.com")->send(new SendMail());
        $customers = $this->customer->data($request);

        return view('customer.index', compact('customers'));
    }

    public function getLogin()
    {
        return view('customer.login');
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
        $validator = \Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        $data['password'] = bcrypt($data['password']);
        $user = Customer::create($data);
        Mail::to($user->email)->send(new SendMail());
        return redirect()->route('login');

    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
                'name' => "required| string| max:255",
                'email' => "required|string|email|max:255|unique:customer",
                'password' => 'required| min:5|confirmed',
                'password_confirmation' => 'required'
            ]
        );
//        try {
//            $data = $this->customer->data($request);
//            $this->customer->fill($data)->save();
//        } catch (\Exception $e) {
//            return redirect()->back()->with("error", $e->getMessage());
//        }
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address
        ]);
        return redirect()->route('customer.index')->with("success", "Create Success");
    }

    public function edit($id, Request $request)
    {
        $customer = $this->customer->find($id);
        return view('customer.edit', compact('customer'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
                'name' => "required| string| max:255",
                'email' => "required|string|email|max:255|unique:customer",
                'password' => 'required| min:5|confirmed',
                'password_confirmation' => 'required'
            ]
        );
        $customer = $this->customer->find($id);
        $customer->update($request->all());
        return redirect()->route('customer.index');
    }

    public function posts($id,Request $request)
    {
        $customer = $this->customer->find($id);
        $request['customer_id'] = $customer->id;
        $posts = $this->post->getData($request);
        return view('customer.post',compact('posts','customer'));
    }


}
