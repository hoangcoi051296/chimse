<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        return view('employee.dashboard');
    }
    public function editAccount(){

    }
    public function updateAccount(){

    }
}
