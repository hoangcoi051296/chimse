<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreated;
use App\Models\District;
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
        $address = District::where('matp', 01)->get();
        view()->share(compact('address'));

    }

    public function index(Request $request)
    {
        $customers = $this->customer->data($request);
        $customers1=  $this->customer->get();
        return view('manager.customer.index', compact('customers','customers1'));
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
            'ward_id' => $request->ward,
            'district_id' => $request->district
        ]);
        return redirect()->route('manager.customer.index')->withSuccess("Tạo mới thành công");
    }

    public function edit($id, Request $request)
    {
        $customer = $this->customer->find($id);
        return view('manager.customer.edit', compact('customer'));
    }

    public function update($id, Request $request)
    {
       $customer = $this->customer->find($id);
       $customer->update([
           'email' => $request->email,
           'phone' => $request->phone,
           'ward_id' => $request->ward,
           'district_id' => $request->district
       ]);
        return redirect()->route('manager.customer.index')->withSuccess("Sửa thành công");
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        if($customer){
            $customer->delete();
        }
        return redirect()->back()->withSuccess("Xóa thành công");
    }

    public function posts($id,Request $request)
    {
        $customer = $this->customer->find($id);
        $request['customer_id'] = $customer->id;
        $posts = $this->post->getData($request);

        return view('manager.customer.post.index',compact('customer','posts'));
    }
}
