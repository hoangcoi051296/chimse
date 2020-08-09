<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Address_QuanHuyen;
use App\Models\Customer;
use App\Models\Post;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customer;
    protected $post;

    public function __construct(Customer $customer, Post $post)
    {
        $this->customer = $customer;
        $this->post = $post;
        $address = Address_QuanHuyen::where('matp', 01)->get();
        view()->share(compact('address'));
    }

    public function index(Request $request)
    {
        $customers = $this->customer->data($request);
        return view('manager.customer.index', compact('customers'));
    }

    public function create()
    {
        return view('manager.customer.create');
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
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address
        ]);
        return redirect()->route('manager.customer.index')->with("success", "Create Success");
    }

    public function edit($id, Request $request)
    {
        $customer = $this->customer->find($id);
        return view('manager.customer.edit', compact('customer'));
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
//        $customer = $this->customer->find($id);
//        $customer->update($request->all());
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address
        ]);
        return redirect()->route('manager.customer.index');
    }

    public function delete($id)
    {
        Customer::find($id)->delete();
        return redirect()->back();
    }

    public function posts($id,Request $request)
    {
        $customer = $this->customer->find($id);
        $request['customer_id'] = $customer->id;
        $posts = $this->post->getData($request);

        return view('customer.post',compact('customer','posts'));
    }
}
