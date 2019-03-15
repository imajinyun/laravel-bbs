<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {

    // 默认路由
    Route::get('/', 'HomeController@index')->name('dashboard');

    // 用户相关路由
    Route::resource('users', 'UsersController');
});
