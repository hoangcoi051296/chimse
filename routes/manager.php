<?php
use Illuminate\Support\Facades\Route;
Route::group([ 'namespace' => 'Manager', 'middleware' => 'checkLoginManager'], function () {
    Route::get('/', 'ManagerController@index')->name('manager.index');
    Route::get('/edit', 'ManagerController@editAccount')->name('manager.account.edit');
    Route::post('/edit/{id}', 'ManagerController@updateAccount')->name('manager.account.update');
    Route::group(['prefix' => 'employee'], function () {
        Route::get('/', 'HelperController@index')->name('manager.employee.index');
        Route::get('create', 'HelperController@create')->name('manager.employee.create');
        Route::post('store', 'HelperController@store')->name('manager.employee.store');
        Route::get('edit/{id}', 'HelperController@edit')->name('manager.employee.edit');
        Route::get('details/{id}', 'HelperController@details')->name('manager.employee.details');
        Route::post('update/{id}', 'HelperController@update')->name('manager.employee.update');
        Route::get('delete/{id}', 'HelperController@delete')->name('manager.employee.delete');
    });
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', 'CustomerController@index')->name('manager.customer.index');
        Route::get('/{id}/post', 'CustomerController@posts')->name('manager.customer.post.index');
        Route::get('create', 'CustomerController@create')->name('manager.customer.create');
        Route::post('store', 'CustomerController@store')->name('manager.customer.store');
        Route::get('edit/{id}', 'CustomerController@edit')->name('manager.customer.edit');
        Route::post('update/{id}', 'CustomerController@update')->name('manager.customer.update');
        Route::get('delete/{id}', 'CustomerController@delete')->name('manager.customer.delete');

    });
    Route::group(['prefix'=>'category'],function (){
        Route::get('/', 'CategoryController@index')->name('manager.category.index');
        Route::get('create', 'CategoryController@create')->name('manager.category.create');
        Route::post('store', 'CategoryController@store')->name('manager.category.store');
        Route::get('edit/{id}', 'CategoryController@edit')->name('manager.category.edit');
        Route::post('update/{id}', 'CategoryController@update')->name('manager.category.update');
        Route::get('delete/{id}', 'CategoryController@delete')->name('manager.category.delete');
    });
    Route::group(['prefix'=>'attribute'],function (){
        Route::get('/', 'AttributeController@index')->name('manager.attribute.index');
        Route::get('create', 'AttributeController@create')->name('manager.attribute.create');
        Route::post('store', 'AttributeController@store')->name('manager.attribute.store');
        Route::get('edit/{id}', 'AttributeController@edit')->name('manager.attribute.edit');
        Route::post('update/{id}', 'AttributeController@update')->name('manager.attribute.update');
        Route::get('delete/{id}', 'AttributeController@delete')->name('manager.attribute.delete');
    });
    Route::group(['prefix'=>'post'],function (){
        Route::get('/', 'PostController@index')->name('manager.post.index');
        Route::get('create', 'PostController@create')->name('manager.post.create');
        Route::post('store', 'PostController@store')->name('manager.post.store');
        Route::get('details/{id}', 'PostController@details')->name('manager.post.details');
        Route::post('changeStatus', 'PostController@changeStatus')->name('manager.post.changeStatus');
        Route::get('edit/{id}', 'PostController@edit')->name('manager.post.edit');
        Route::post('update/{id}', 'PostController@update')->name('manager.post.update');
        Route::post('updateStatus/{id}', 'PostController@updateStatus')->name('manager.post.updateStatus');
        Route::get('delete/{id}', 'PostController@delete')->name('manager.post.delete');
    });
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', 'RoleController@index')->name('manager.role.index');
        Route::get('create', 'RoleController@create')->name('manager.role.create');
        Route::post('store', 'RoleController@store')->name('manager.role.store');
        Route::get('edit/{id}', 'RoleController@edit')->name('manager.role.edit');
        Route::post('update/{id}', 'RoleController@update')->name('manager.role.update');
        Route::get('delete/{id}', 'RoleController@delete')->name('manager.role.delete');

    });

});
Route::group(['namespace' => 'Auth\Manager'], function () {
    Route::get('/login', 'ManagerLoginController@showLoginForm')->name('manager.login');
    Route::post('/login', 'ManagerLoginController@login')->name('manager.postLogin');
    Route::get('logout', function () {
        Auth::logout();
        session()->flush();
        return redirect()->route('manager.login');
    })->name('manager.logout');
});
