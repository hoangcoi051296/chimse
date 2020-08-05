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
    public function editAccount($id){
       $manager=Auth::guard('manager')->user();
        return view('manager.account.edit',compact('manager'));
    }
    public function updateAccount(){

    }
}
