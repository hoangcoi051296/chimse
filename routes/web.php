<?php

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
Route::get('/',function(){
   return view('welcome');
});
Route::group(['prefix' => 'manager','namespace'=>'Manager'], function () {
    Route::get('/login', 'LoginController@login')->name('manager.login');
    Route::get('/test', 'LoginController@login')->name('manager.test');
    Route::post('/login','LoginController@postLogin')->name('manager.postLogin');



    });
Route::group(['prefix' => 'customer','namespace'=>'Customer'], function () {



});
