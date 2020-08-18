<?php

namespace App\Http\Controllers\Customer;

use App\Models\District;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Ward;
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
        $request['customer_id'] = $user->id;
        $posts = $this->post->getData($request);
        return view('customer.post.index', compact('posts'));
    }

    public function showWardInDistrict(Request $request)
    {
            $wards = Ward::Where('maqh', $request->address)->get();
            return response()->json($wards);
    }

    public function create()
    {
        $categories = $this->category->all();
        return view('customer.post.create', compact('categories'));
    }

    public function store(Request $request)
    {
            $data = $request->all();
            $request->validate($this->post->rules());
            $data['status'] = Post::ChoDuyet;
            $data['customer_id'] = Auth::guard('customer')->user()->id;
            $this->post->createData($data);

        return redirect()->route('customer.post.index')->with("success", "Create Success");
    }

    public function edit($id)
    {
        $post = $this->post->find($id);
        $categories = $this->category->all();
        return view('customer.post.edit', compact('post', 'categories'));
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $request->validate($this->post->rules());

        $data['status'] = Post::ChoDuyet;
        $data['customer_id'] = Auth::guard('customer')->user()->id;
        $this->post->updateData($data, $id);

        return redirect()->route('customer.post.index')->with("success", "Create Success");
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete($id);
        return redirect()->route('customer.post.index')->withSuccess('Xóa thành công');
    }
}
