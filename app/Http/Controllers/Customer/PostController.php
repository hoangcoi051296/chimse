<?php

namespace App\Http\Controllers\Customer;

use App\Models\District;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Post;
use App\Models\Ward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

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
        $category = Category::all();
        return view('customer.post.index', compact('posts', 'category'));
    }

    public function showWardInDistrict(Request $request)
    {
        $wards = Ward::Where('maqh', $request->address)->get();
        return response()->json($wards);
    }

    public function complete($id)
    {
        $post = Post::find($id);
        return view('customer.feedback.create', compact('post'));
    }

    public function feedback(Request $request)
    {
        $post = Post::find($request->post_id);
        $customer = Auth::guard('customer')->user();
        $customer->employee()->attach($post->employee_id, [
            'comment' => $request->comment,
            'rating' => $request->rating,
            'post_id' => $post->id,
        ]);
        $employee =Employee::find($post->employee_id);
        $a =DB::table('feedback')->where('employee_id',$employee->id)->get();
        $avgRate =  $a->avg('rating');
        $employee->avgRate=$avgRate;
        $employee->save();
        $post->status = 7;
        $post->save();
        return redirect()->route('customer.post.index');
    }

    public function changeUserStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 'User status change successfully.']);
    }

    public function create()
    {
        $categories = $this->category->all();
        return view('customer.post.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['time_start']=date('Y-m-d H:i:s',strtotime($data['time_start']));
        $data['time_end']=date('Y-m-d H:i:s',strtotime($data['time_end']));
        $rules = $this->post->rules();
        $messages = $this->post->messages();
        $request->validate($rules, $messages);

        $data['status'] = 1;
        $data['customer_id'] = Auth::guard('customer')->user()->id;
        $this->post->createData($data);
        return redirect()->route('customer.post.index')->withSuccess("Tạo mới thành công");
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
        $data['time_start']=date('Y-m-d H:i:s',strtotime($data['time_start']));
        $data['time_end']=date('Y-m-d H:i:s',strtotime($data['time_end']));
        $data['status'] = 1;
        $data['customer_id'] = Auth::guard('customer')->user()->id;
        $this->post->updateData($data, $id);
        return redirect()->route('customer.post.index')->withSuccess("Sửa thành công");
    }
    public function changeStatus($id){
            $post=Post::find($id);
            $post->status=7;
            $post->update();
            return redirect()->back()->with('success','Xác nhận công việc thành công');
        }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete($id);
        return redirect()->route('customer.post.index')->withSuccess('Xóa thành công');
    }
}
