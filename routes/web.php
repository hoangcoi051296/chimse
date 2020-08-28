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
    $start_date = strtotime(now()->subDay(rand(0,15)));
    $end_date = strtotime(now()->addDay(rand(0,15)));
    $val =rand($start_date,$end_date);
    $dateTime = new DateTime(date('Y-m-d H:i:s', $val));
    $start=$dateTime->format('Y-m-d H:i:s');
    $endTime=$dateTime->add(new DateInterval('PT'.rand(2,6).'H'));
    $end=  $endTime->format('Y-m-d H:i:s');
    dd($start.'-'.$end);
    return view('welcome');
});
Route::get('showWard','HomeController@showWardInDistrict')->name('showWard');
Route::get('getAttribute','HomeController@getAttribute')->name('getAttributes');
Route::get('getTimeline','HomeController@getTimeline')->name('getTimeline');


Route::get('autocomplete','HomeController@search')->name('autocomplete');





