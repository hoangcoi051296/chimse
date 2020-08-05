<?php

use Illuminate\Support\Facades\Route;
Route::group(['namespace' => 'Auth\Customer'], function () {
    Route::get('/login', 'CustomerLoginController@getLogin')->name('customer.login');
    Route::post('/login', 'CustomerLoginController@postLogin')->name('customer.postLogin');
    Route::get('register', 'CustomerRegisterController@getRegister')->name('customer.register');
    Route::post('register', 'CustomerRegisterController@postRegister')->name('customer.postRegister');
    Route::get('forgot-password', 'ForgotPasswordController@getForget')->name('customer.forgot');
    Route::post('forgot-password', 'ForgotPasswordController@postForget')->name('customer.forgot.post');
    Route::get('complete-password/{id}/{code}', 'ForgotPasswordController@getForgetComplete')->name('customer.forgot.complete');
    Route::post('forgot-reset/{id}', 'ForgotPasswordController@resetPass')->name('customer.forgot.reset');
//    Route::get('logout', function () {
//        Auth::logout();
//        session()->flush();
//        return redirect()->route('customer.login');
//    });
    Route::get('verify/{id}/{token}', 'CustomerRegisterController@activeAccount')->name('customer.active.account');
});

Route::group(['namespace' => 'Customer'], function () {
    Route::get('/', 'CustomerController@index',function (){dd("asdas");})->name('customer.index');
    Route::group(['prefix' => 'account'], function () {
        Route::get('/edit/{id}', 'CustomerController@edit')->name('customer.edit');
        Route::post('/edit/{id}', 'CustomerController@update')->name('customer.update');
    });
    Route::group(['prefix' => 'post'], function () {
        Route::get('/', 'PostController@index')->name('customer.post.index');
        Route::get('create', 'PostController@create')->name('customer.post.create');
        Route::post('store', 'PostController@store')->name('customer.post.store');
        Route::get('edit/{id}', 'PostController@edit')->name('customer.post.edit');
        Route::post('update/{id}', 'PostController@update')->name('customer.post.update');
        Route::get('delete/{id}', function ($id) {
            Post::find($id)->delete();
            return redirect()->back();
        })->name('customer.post.delete');
    });
});
