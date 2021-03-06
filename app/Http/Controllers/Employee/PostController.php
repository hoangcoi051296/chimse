<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
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
        $condition=$request->all();
        $posts = $this->post->getData($condition);
       $posts=$posts->where('employee_id',Auth::guard('employee')->user()->id);
        return view('employee.post.index',compact('posts'));
    }
    public function details($id){
        $post = $this->post->find($id);
        return view('employee.post.details',compact('post'));
    }
    public function update($id, Request $request){
        $post=Post::find($id);
        $employee=Auth::guard('employee')->user();
        $data=$request->all();
        if ($request->status==Post::DaDuyet){
            $data['employee_id']=null;
            $employee->status=Employee::ChoViec;
        }
        if ($request->status==Post::NGVXacNhanCV){
            $employee->status=Employee::XacNhanCV;
        }
        if ($request->status==Post::NGVBatDau){
            $employee->status=Employee::BatDau;
        }
        if ($request->status==Post::NGVKetThuc){
            $employee->status=Employee::HoanThanh;
        }
        $post->fill($data)->save();
        $employee->save();
    }
}
