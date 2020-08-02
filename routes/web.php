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

        Route::group(['prefix' => 'helper'], function () {
            Route::get('/','HelperController@index')->name('manager.helper.index');
            Route::get('create','HelperController@create')->name('manager.helper.create');
            Route::post('store','HelperController@store')->name('manager.helper.store');
            Route::get('edit/{id}','HelperController@edit')->name('manager.helper.edit');
            Route::post('update/{id}','HelperController@update')->name('manager.helper.update');
            Route::get('delete/{id}','HelperController@delete')->name('manager.helper.delete');
        });
    });

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
