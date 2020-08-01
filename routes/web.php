<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'manager', 'namespace' => 'Manager'], function () {
    Route::get('/login', 'LoginController@login')->name('manager.login')->middleware('checkLogout');
    Route::post('/login', 'LoginController@postLogin')->name('manager.postLogin');
    Route::get('logout', function () {
        Auth::logout();
        session()->flush();
        return redirect()->route('manager.login');
    });
    Route::group(['middleware' => 'checkLogin'], function () {
        Route::get('/', 'ManagerController@index')->name('manager.index');
    });

    Route::get('helper','HelperController@index')->name('manager.helper.index');
    Route::get('helper/create','HelperController@create')->name('manager.helper.create');
    Route::post('helper/store','HelperController@store')->name('manager.helper.store');

});
Route::group(['prefix' => 'customer', 'namespace' => 'Customer'], function () {


});

Route::group(['prefix' => 'helper', 'namespace' => 'Helper'], function () {
    Route::get('/login', 'LoginController@login')->name('helper.login')->middleware('checkLogout');
    Route::post('/login', 'LoginController@postLogin')->name('helper.postLogin');
    Route::get('/register', 'LoginController@register')->name('helper.register');
    Route::get('logout', function () {
        Auth::logout();
        session()->flush();
        return redirect()->route('helper.login');
    });
    Route::group(['middleware' => 'checkLogin'], function () {
        Route::get('/', 'HelperController@index')->name('helper.index');
    });


});

