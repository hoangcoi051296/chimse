<?php

use App\Models\Category;
use App\Models\District;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    $wards =District::where('matp', 01)->pluck('maqh')->toArray();
    dd($wards);
    return view('welcome');
});
Route::get('showWard','HomeController@showWardInDistrict')->name('showWard');
Route::get('getAttribute','HomeController@getAttribute')->name('getAttributes');
Route::get('getTimeline','HomeController@getTimeline')->name('getTimeline');


Route::get('autocomplete','HomeController@search')->name('autocomplete');





