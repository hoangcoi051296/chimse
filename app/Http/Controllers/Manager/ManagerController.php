<?php

namespace App\Http\Controllers\Manager;
use App\Models;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index(){
        return view('manager.dashboard');
    }
}
