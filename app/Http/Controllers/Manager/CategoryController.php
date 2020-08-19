<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category){
        $this->category=$category;
    }
    public function index(){
        $categories= $this->category->all();
        return view('manager.category.index', compact('categories'));
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
