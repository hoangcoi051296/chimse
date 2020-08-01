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
Route::group(['prefix' => 'customer','namespace'=>'Customer'], function () {
    Route::get('login', 'CustomerController@getLogin')->name('login');
    Route::post('login', 'CustomerController@postLogin');
    Route::get('register', 'CustomerController@getRegister')->name('register');
    Route::post('register', 'CustomerController@postRegister');
    Route::group(['prefix' => 'admin'], function (){
        Route::get('/index', 'CustomerController@index')->name('customer.index');
    });
});

