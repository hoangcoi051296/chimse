<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Employee;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    protected $employee;
    public function __construct(
        Employee $employee
    ) {
        $this->employee = $employee;
        $address = District::where('matp', 01)->get();
        view()->share(compact('address'));
    }
    public function index(){
        return view('employee.dashboard');
    }
    public function feedback(){
        $employee=Auth::guard('employee')->user();

        return view('employee.feedback.index',compact('employee'));
    }
    public function editAccount(){
        $employee=Auth::guard('employee')->user();
        return view('employee.account.edit',compact('employee'));
    }
    public function updateAccount(Request $request ,$id){
        $request->validate([
            "name"=> "sometimes|string|unique:employee,name,".$id,
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data=$request->all();
        $employee=Employee::find($id);
        try {
            $image = null;
            if($request->hasFile("image")){
                $file = $request->file("image");
                $file_name = time()."_".$file->getClientOriginalName();
                $file->move("upload/avatar/employee/",$file_name);
                $image = "upload/avatar/employee/".$file_name;
            }
            $data['avatar']=$image;
            $data= array_filter($data);
            $employee->fill($data)->save();
        }catch (\Exception $e){
            return redirect()->back();
        }
        return redirect()->route('employee.account.edit')->with("success","Cập nhật thành công");
    }
}
