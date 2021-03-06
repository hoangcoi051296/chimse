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
    Route::get('logout', 'CustomerLoginController@logout')->name('customer.logout');
    Route::get('verify/{id}/{token}', 'CustomerRegisterController@activeAccount')->name('customer.active.account');
});

Route::group(['namespace' => 'Customer', 'middleware' => 'checkLoginCustomer'], function () {
    Route::get('/', 'CustomerController@index')->name('customer.index');
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/edit/{id}', 'CustomerController@editProfile')->name('customer.profile.edit');
        Route::post('/edit/{id}', 'CustomerController@updateProfile')->name('customer.profile.update');
    });
    Route::group(['prefix' => 'post'], function () {
        Route::get('/', 'PostController@index')->name('customer.post.index');
        Route::get('create', 'PostController@create')->name('customer.post.create');
        Route::post('store', 'PostController@store')->name('customer.post.store');
        Route::get('edit/{id}', 'PostController@edit')->name('customer.post.edit');
        Route::post('update/{id}', 'PostController@update')->name('customer.post.update');
        Route::get('delete/{id}', 'PostController@delete')->name('customer.post.delete');
        Route::get('complete/{id}', 'PostController@complete')->name('customer.post.complete');
        Route::post('complete', 'PostController@feedback')->name('customer.post.feedback');
        Route::post('changeStatus/{id}', 'PostController@changeStatus')->name('customer.post.changeStatus');
        Route::get('showWard', 'PostController@showWardInDistrict')->name('customer.get.showWard');
    });
    Route::group(['prefix' => 'feedback'], function () {
        Route::get('/', 'FeedbackController@index')->name('customer.feedback.index');
        Route::get('edit/{id}', 'FeedbackController@edit')->name('customer.feedback.edit');
        Route::post('edit/{id}', 'FeedbackController@update')->name('customer.feedback.update');
    });
});
