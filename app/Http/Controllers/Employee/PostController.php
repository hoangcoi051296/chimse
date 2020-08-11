<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
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
       $post=Post::where('employee_id',Auth::guard('employee')->user()->id)->get();
       dd($post);
        return view('manager.post.index',compact('posts'));
    }
}
