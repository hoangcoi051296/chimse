<?php

namespace App\Http\Controllers\Customer;


use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Models\Post;
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

    }

    public function index(Request $request)
    {
        $customers = $this->customer->data($request);
        $posts = Post::get();
        return view('customer.dashboard', compact('customers', 'posts'));
    }

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
