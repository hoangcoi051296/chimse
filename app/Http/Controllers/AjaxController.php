<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function __construct(){

    }

    public function getDistrictByPro(Request $request)
    {
        $districts = District::where('matp',$request->get('id'))->get();
        return response()->json([
            'errors' => false,
            'data' => $districts
        ]);
    }
    public function getCommuneByDis(Request $request)
    {
        $communes = Commune::where('maqh',$request->get('id'))->get();
        return response()->json([
            'errors' => false,
            'data' => $communes
        ]);
    }
}
