<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'ajax'], function (\Illuminate\Routing\Router $router) {
    $router->get('district-by-province',[
        'as' => 'district.by.province',
        'uses' => 'AjaxController@getDistrictByPro'
    ]);
    $router->get('commune-by-district',[
        'as' => 'commune.by.district',
        'uses' => 'AjaxController@getCommuneByDis'
    ]);
});