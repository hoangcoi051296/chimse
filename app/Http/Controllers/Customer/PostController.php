<?php

namespace App\Http\Controllers\Customer;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\PostDec;
use App\Category;
use App\Http\Requests\PostCreated;

class PostController extends Controller
{
    protected $post;
    protected $category;
    public function __construct(Post $post, Category $category){
        $this->post = $post;
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $user = Auth::guard('customer')->user();
        $request['customer_id'] = $user->id;
        $posts = $this->post->getData($request);
        return view('post.index',compact('posts'));
    }

    public function create()
    {
        $categories = $this->category->all();
        return view('post.create',compact('categories'));
    }

    public function store(PostCreated $request)
    {
        $user = Auth::guard('customer')->user();
        $data = $request->all();
        $data['customer_id'] = $user->id;
        $data['status'] = 0;
        $post = $this->post->create($data);

        return redirect()->route('customer.post.index');
    }

    public function edit($id)
    {
        $post = $this->post->find($id);
        $categories = $this->category->all();
        return view('post.edit',compact('post','categories'));
    }

    public function update($id,Request $request)
    {
        $user = Auth::guard('customer')->user();
        $data = $request->all();
        $data['customer_id'] = $user->id;
        $data['status'] = 0;

        $post = $this->post->find($id)->update($data);

        return redirect()->route('customer.post');
    }
}