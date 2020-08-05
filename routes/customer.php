<?php
use Illuminate\Support\Facades\Route;
Route::group(['namespace' => 'Customer'], function () {
    Route::get('/', 'CustomerController@index')->name('customer.index');
    Route::group(['prefix'=>'account'],function (){
        Route::get('/edit/{id}', 'CustomerController@edit')->name('customer.edit');
        Route::post('/edit/{id}', 'CustomerController@update')->name('customer.update');
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
Route::group(['namespace' => 'Auth\Customer'], function () {
    Route::get('/login', 'CustomerLoginController@showLoginForm')->name('customer.login')->middleware('checkLogout');
    Route::post('/login', 'CustomerLoginController@login')->name('customer.postLogin');
    Route::get('register', 'CustomerRegisterController@getRegister')->name('customer.register');
    Route::post('register', 'CustomerRegisterController@postRegister')->name('customer.postRegister');
    Route::get('logout', function () {
        Auth::logout();
        session()->flush();
        return redirect()->route('employee.login');
    });
});
