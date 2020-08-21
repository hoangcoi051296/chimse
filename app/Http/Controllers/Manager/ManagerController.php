<?php

namespace App\Http\Controllers\Manager;
use App\Models\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function index(){
        return view('manager.dashboard');
    }
    public function editAccount(){
       $manager=Auth::guard('manager')->user();
        return view('manager.account.edit',compact('manager'));
    }
    public function updateAccount(Request $request ,$id){
        $request->validate([
            "name"=> "sometimes|string|unique:managers,name,".$id,
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data=$request->all();
        $manager=Manager::find($id);
        try {
            $image = null;
            if($request->hasFile("image")){
                $file = $request->file("image");
                $file_name = time()."_".$file->getClientOriginalName();
                    $file->move("upload/avatar",$file_name);
                    $image = "upload/avatar/".$file_name;
            }
            $data['avatar']=$image;
            $data= array_filter($data);
            $manager->fill($data)->save();
        }catch (\Exception $e){
            return redirect()->back();
        }
        return redirect()->route('manager.account.edit')->with("success","Cập nhật tài khoản thành công");
    }
}
