<?php
use Illuminate\Support\Facades\Route;
Route::group(['namespace'=>'Employee','middleware'=>'checkLoginEmployee'],function (){
    Route::get('/','EmployeeController@index')->name('employee.index');
    Route::group(['prefix'=>'account'],function (){
        Route::get('/edit', 'EmployeeController@editAccount')->name('employee.account.edit');
        Route::post('/edit/{id}', 'EmployeeController@updateAccount')->name('employee.account.update');
    });
    Route::get('feedback','EmployeeController@feedback')->name('employee.feedback');
    Route::get('post','PostController@index')->name('employee.post.index');
    Route::get('post/details/{id}','PostController@details')->name('employee.post.details');
    Route::post('post/update/{id}','PostController@update')->name('employee.post.update');
});
Route::group(['namespace' => 'Auth\Employee'], function () {
    Route::get('/login', 'EmployeeLoginController@showLoginForm')->name('employee.login');
    Route::post('/login', 'EmployeeLoginController@login')->name('employee.postLogin');
    Route::get('logout', function () {
        Auth::logout();
        session()->flush();
        return redirect()->route('employee.login');
    })->name('employee.logout');
});
