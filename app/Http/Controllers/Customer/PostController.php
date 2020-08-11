<?php

namespace App\Http\Controllers\Customer;

use App\Models\District;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\PostCreated;

class PostController extends Controller
{
    protected $post;
    protected $category;

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;

        $address = District::where('matp', 01)->get();

        view()->share(compact('address'));
    }

    public function index(Request $request)
    {
        $user = Auth::guard('customer')->user();
//        $request['customer_id'] = $user->id;
        $posts = $this->post->getData($request);
        return view('customer.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = $this->category->all();
        return view('customer.post.create', compact('categories'));
    }

    public function store(PostCreated $request)
    {
        $user = Auth::guard('customer')->user();
        $data = $request->all();
        $data['customer_id'] = $user->id;
        $data['status'] = 1;
        $post = $this->post->create($data);

        return redirect()->route('customer.post.index');
    }

    public function edit($id)
    {
        $post = $this->post->find($id);
        $categories = $this->category->all();
        return view('customer.post.edit', compact('post', 'categories'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('customer')->user();
        $data = $request->all();
        $data['customer_id'] = $user->id;
        $data['status'] = 1;

        $post = $this->post->find($user->id)->update($data);

        return redirect()->route('customer.post.index', compact('post'));
    }
}
