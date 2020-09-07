<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    // Route::group(['middleware' => ['role:Admin']], function () {
        Route::post('permission/give', 'Admin\PermissionController@give')->name('give');
        Route::resource('permission', 'Admin\PermissionController');
        Route::resource('role', 'Admin\RoleController');
        Route::post('user/new', 'Admin\UserController@new')->name('user.new');
        Route::resource('user', 'Admin\UserController');
    // });
});
