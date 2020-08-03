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
Route::group(['prefix' => 'customer', 'namespace' => 'Customer'], function () {
    Route::group(['prefix' => 'admin'], function () {

    });
});
Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'manager', 'namespace' => 'Manager', 'middleware' => 'checkLogin'], function () {
    Route::get('/', 'ManagerController@index')->name('manager.index');
    Route::group(['prefix' => 'helper'], function () {
        Route::get('/', 'HelperController@index')->name('manager.helper.index');
        Route::get('create', 'HelperController@create')->name('manager.helper.create');
        Route::post('store', 'HelperController@store')->name('manager.helper.store');
        Route::get('edit/{id}', 'HelperController@edit')->name('manager.helper.edit');
        Route::post('update/{id}', 'HelperController@update')->name('manager.helper.update');
        Route::get('delete/{id}', 'HelperController@delete')->name('manager.helper.delete');
    });
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', 'CustomerController@index')->name('manager.customer.index');
        Route::get('create', 'CustomerController@create')->name('manager.customer.create');
        Route::post('store', 'CustomerController@store')->name('manager.customer.store');
        Route::get('edit/{id}', 'CustomerController@edit')->name('manager.customer.edit');
        Route::post('update/{id}', 'CustomerController@update')->name('manager.customer.update');
        Route::get('delete/{id}', 'CustomerController@delete')->name('manager.customer.delete');
    });

});
Route::group(['prefix' => 'customer', 'namespace' => 'Customer'], function () {
    Route::group(['prefix'=>'account'],function (){
        Route::get('/', 'CustomerController@index')->name('customer.index');
        Route::get('/edit/{id}', 'CustomerController@edit')->name('customer.edit');
        Route::post('/edit/{id}', 'CustomerController@update')->name('customer.update');
        Route::get('/delete/{id}','CustomerController@delete')->name('customer.delete');
    });
    Route::group(['prefix'=>'post'],function (){
        Route::get('/', 'CustomerController@posts')->name('customer.post');
        Route::get('create','CustomerController@create')->name('customer.post.create');
        Route::post('store','CustomerController@store')->name('customer.post.store');
        Route::get('edit/{id}','PostController@edit')->name('customer.post.edit');
        Route::post('edit/{id}','PostController@update')->name('customer.post.update');
        Route::get('delete/{id}', function($id){
            Post::find($id)->delete();
            return redirect()->back();
        })->name('customer.post.delete');
    });
});






Route::group(['prefix' => 'helper', 'namespace' => 'Auth\Employee'], function () {
    Route::get('/login', 'EmployeeLoginController@login')->name('helper.login')->middleware('checkLogout');
    Route::post('/login', 'EmployeeLoginController@postLogin')->name('helper.postLogin');
    Route::get('logout', function () {
        Auth::logout();
        session()->flush();
        return redirect()->route('helper.login');
    });
});
Route::group(['prefix' => 'customer', 'namespace' => 'Auth\Customer'], function () {
    Route::get('/login', 'CustomerLoginController@getLogin')->name('customer.login')->middleware('checkLogout');
    Route::post('/login', 'CustomerLoginController@postLogin')->name('customer.postLogin');
    Route::get('register', 'CustomerRegisterController@getRegister')->name('customer.register');
    Route::post('register', 'CustomerRegisterController@postRegister')->name('customer.postRegister');
    Route::get('logout', function () {
        Auth::logout();
        session()->flush();
        return redirect()->route('helper.login');
    });
});
Route::group(['prefix' => 'manager', 'namespace' => 'Auth\Manager'], function () {
    Route::get('/login', 'ManagerLoginController@login')->name('manager.login')->middleware('checkLogout');
    Route::post('/login', 'ManagerLoginController@postLogin')->name('manager.postLogin');
    Route::get('logout', function () {
        Auth::logout();
        session()->flush();
        return redirect()->route('manager.login');
    });
});

