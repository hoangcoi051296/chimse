<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Customer;
use App\Post;
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
        Route::get('/edit/{id}', 'CustomerController@edit')->name('customer.edit');
        Route::post('/edit/{id}', 'CustomerController@update')->name('customer.update');
        Route::get('/delete/{id}', function($id){
            Customer::find($id)->delete();
            return redirect()->back();
        })->name('customer.delete');
        Route::get('/customer/{id}/posts', 'CustomerController@posts')->name('customer.post');
        Route::get('customer/create','CustomerController@create')->name('customer.create');
        Route::post('customer/store','CustomerController@store')->name('customer.store');
        Route::get('customer/post','PostController@index')->name('customer.post.index');
        Route::get('customer/post/create','PostController@create')->name('customer.post.create');
        Route::post('customer/post/create','PostController@store')->name('customer.post.store');
        Route::get('customer/post/edit/{id}','PostController@edit')->name('customer.post.edit');
        Route::post('customer/post/edit/{id}','PostController@update')->name('customer.post.update');
        Route::get('customer/post/delete/{id}', function($id){
            Post::find($id)->delete();
            return redirect()->back();
        })->name('customer.post.delete');
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

