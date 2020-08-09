<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\SendMail;

class CustomerController extends Controller
{
    protected $customer;
    protected $post;

    public function __construct(Customer $customer, Post $post)
    {
        $this->customer = $customer;
        $this->post = $post;
        $provinces = Province::get();
        view()->share(compact('provinces'));
    }

    public function index(Request $request)
    {
        $customers = $this->customer->data($request);

        return view('customer.dashboard', compact('customers'));
    }

//    public function create()
//    {
//        return view('customer.create');
//    }
//
//    public function store(Request $request)
//    {
//        $request->validate([
//                'name' => "required| string| max:255",
//                'email' => "required|string|email|max:255|unique:customer",
//                'password' => 'required| min:5|confirmed',
//                'password_confirmation' => 'required'
//            ]
//        );
//        $customer = Customer::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => bcrypt($request->password),
//            'phone' => $request->phone,
//            'address' => $request->address
//        ]);
//        return redirect()->route('customer.index')->with("success", "Create Success");
//    }

    public function editProfile(Request $request,$id)
    {
        $user = Auth::guard('customer')->user();
        $customer = $this->customer->find($id);
        $request['customer_id'] = $customer->id;
        return view('customer.profile.edit', compact('user'));
    }

    public function updateProfile($id, Request $request)
    {
        $request->validate([
                'name' => "required| string| max:255",
                'email' => "required|string|email|max:255|unique:customer",
                'address' => 'required| string| max:255',
                'phone' => 'required'
            ]
        );
        $customer = $this->customer->find($id);
        $customer->update($request->all());
        return redirect()->route('customer.index');
    }

    public function posts(Request $request, $id)
    {
        $customer = $this->customer->find($id);
        $request['customer_id'] = $customer->id;
        $posts = $this->post->getData($request);
        return view('customer.post', compact('posts', 'customer'));
    }


}
