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
    }
    public function index(){
        return view('employee.dashboard');
    }
    public function editAccount(){
            $user=Auth::guard('employee')->user();
            $address = District::where('matp', 01)->get();
        return view('employee.account.edit',compact('user','address'));
    }
    public function updateAccount($id,Request $request){
        $data=$request->all();
        $request->validate($this->employee->rules($id));
        try {
            $this->employee->updateData($data, $id);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('employee.account.edit')->with("success", "Cập nhật thành công");
    }
}
