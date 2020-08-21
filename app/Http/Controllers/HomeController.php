<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
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

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $posts = Post::where('title', 'LIKE', '%' . $request->search . '%')->get();
            if ($posts) {
                foreach ($posts as $post) {
                    $output .= '<tr>
                    <td>' .  $post->title . '</td>
                    <td>'. getStatus($post->status)  .'</td>
                    <td>' . $post->description . '</td>
                    <td>' . $post->price . '</td>
                    </tr>';
                }
            }

            return Response($output);
        }
    }
}
