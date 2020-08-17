<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ward;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function showWardInDistrict(Request $request){

        if ($request->ajax()) {
            $wards = Ward::Where('maqh',$request->address)->get();
            return response()->json($wards);
        }

    }

    public function getAttribute(Request $request){

        if ($request->ajax()) {
            $category =Category::find($request->category_id);
            $attributes= $category->attributes;
            return response()->json($attributes);
        }

    }
}
