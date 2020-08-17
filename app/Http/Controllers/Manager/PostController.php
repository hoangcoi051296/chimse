<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Ward;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $customer;
    protected $post;

    public function __construct(Post $post ,Customer $customer)
    {
        $this->customer=$customer;
        $this->post = $post;
        $address = District::where('matp', 01)->get();
        $categories=Category::all();
        view()->share(compact('address','categories'));
    }
    public function index(Request $request){
        $condition = $request->all();
        $posts = $this->post->getData($condition)->paginate(10);
        return view('manager.post.index',compact('posts'));
    }
    public function changeStatus(Request $request){
        if ($request->ajax()) {
           $post=$this->post->find($request->id);
           $post->status=$post->status+1;
           $post->save();
            return response()->json($post);
        }
    }
    public function create(Request $request)
    {
        $customers=  $this->customer->data($request);
        return view('manager.post.create',compact('customers'));
    }
    public function store(Request  $request){
        $data=$request->all();
        $request->validate($this->post->rules());
        try {
            $this->post->createData($data);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('manager.post.index')->with("success", "Create Success");


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

    public function update($id,Request $request)
    {
        $data=$request->all();
        $request->validate($this->post->rules($id));
        try {
            $this->post->updateData($data, $id);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('manager.post.index')->with("success", "Update Success");
    }

    public function delete($id,$post_id)
    {
        $customer = $this->customer->find($id);
        $post = $this->post->find($post_id);

        $post->delete();

        return redirect()->route('manager.customer.post.index',['id' => $customer->id]);
    }
}
