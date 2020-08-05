<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Address;
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
            $address = Address::where('matp', 01)->get();
        return view('employee.account.edit',compact('user','address'));
    }
    public function updateAccount($id,Request $request){
        $request->validate($this->employee->rules($id));
        try {
            $this->employee->updateData($request, $id);
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('employee.index')->with("success", "Update Success");
    }
}
