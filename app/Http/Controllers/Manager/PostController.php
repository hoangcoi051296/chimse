<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Address_QuanHuyen;
use App\Models\Address_XaPhuong;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $customer;
    protected $post;

    public function __construct(Post $post )
    {
        $this->post = $post;
        $address = Address_QuanHuyen::where('matp', 01)->get();
        $categories=Category::all();
        view()->share(compact('address','categories'));
    }
    public function index(Request $request){
        $condition = $request->all();
        $posts = $this->post->getData($condition)->paginate(10);
        return view('manager.post.index',compact('posts'));
    }
    public function showWardInDistrict(Request $request){

        if ($request->ajax()) {
            $wards = Address_XaPhuong::Where('maqh',$request->address)->get();
            return response()->json($wards);
        }

    }
    public function create()
    {

        return view('manager.post.create');
    }
    public function details($id)
    {
        $post = $this->post->find($id);
        return view('manager.post.details',compact('post'));
    }
    public function edit($id)
    {
        $post = $this->post->find($id);
        return view('manager.post.edit',compact('post'));
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
