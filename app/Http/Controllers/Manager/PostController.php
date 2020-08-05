<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $customer;
    protected $post;

    public function __construct(Customer $customer, Post $post)
    {
        $this->customer = $customer;
        $this->post = $post;
        $address = Address::where('matp', 01)->get();
        view()->share(compact('address'));
    }

    public function edit($id,$post_id,Request $request)
    {
        $customer = $this->customer->find($id);

        $post = $this->post->find($post_id);

        return view('manager.customer.post.edit',compact('customer','post'));


    }

    public function update($id,$post_id,Request $request)
    {
        $customer = $this->customer->find($id);
        $post = $this->post->find($post_id);

        $post->update($request->all());

        return redirect()->route('manager.customer.post.index',['id' => $customer->id]);
    }

    public function delete($id,$post_id)
    {
        $customer = $this->customer->find($id);
        $post = $this->post->find($post_id);

        $post->delete();

        return redirect()->route('manager.customer.post.index',['id' => $customer->id]);
    }
}