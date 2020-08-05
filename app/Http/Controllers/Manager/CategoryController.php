<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return view('manager.category.index');
    }
    public function create(){
        return view('manager.category.create');
    }
    public function store(){

    }
    public function edit(){

    }
    public function update(){

    }
    public  function delete(){

    }
}
