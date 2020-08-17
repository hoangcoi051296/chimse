<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;


class AttributeController extends Controller
{
    protected $attribute;
    public function __construct(Attribute $attribute){
        $this->attribute=$attribute;
    }
    public function index(){

        $attributes=Attribute::all();
//        unset($options[$a]);
//        dd($options);
        return view('manager.category.attribute.index',compact('attributes'));
    }
    public function create(){
        $category=Category::all();
        return view('manager.category.attribute.create',compact('category'));
    }
    public function store(Request $request){
        $data=$request->all();
        $request->validate($this->attribute->rules());
        try {
            $this->attribute->saveData($data);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('manager.attribute.index')->with("success", "Create Success");
    }
    public function edit($id){
        $attribute=Attribute::find($id);
        return view('manager.category.attribute.edit',compact("attribute"));
    }
    public function update(Request $request ,$id){
        $data=$request->all();
        $request->validate($this->attribute->rules($id));
        try {
            $this->attribute->updateData($data,$id);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('manager.attribute.index')->with("success", "Create Success");
    }
    public  function delete($id){

    }
}
