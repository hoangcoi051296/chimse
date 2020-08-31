<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category){
        $this->category=$category;
    }
    public function index(Request $request){
        $condition=$request->all();
        $categories= $this->category->data($condition);
        return view('manager.category.index', compact('categories'));
    }
    public function create(){
        return view('manager.category.create');
    }
    public function store(Request $request){
        $data=$request->all();
        $request->validate($this->category->rules(),$this->category->message());
        try {
            $this->category->createData($data);
        }catch (\Exception $e){
            return back()->with("error","Tạo danh mục thất bại");
        }
        return redirect()->route('manager.category.index')->with('success','Tạo  thành công');
    }
    public function edit($id){
        $category=Category::find($id);
        return view('manager.category.edit',compact('category'));
    }
    public function update(Request $request, $id){
        $data=$request->all();
        $request->validate($this->category->rules($id),$this->category->message());
        try {
            $this->category->updateData($data,$id);
        }catch (\Exception $e){
            return back()->with("error","Cập nhật thất bại");
        }
        return redirect()->route('manager.category.index')->with('success','Cập nhật thành công');
    }
    public  function delete($id){
        $category=Category::find($id);
        DB::beginTransaction();
        try {

            $category->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Xoá thất bại');
        }
        return redirect()->route('manager.category.index')->with('success', 'Xoá thành công');
    }
}
