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

    Route::post('files/upload', 'FilesController@upload')->name('files.upload');
    Route::post('files/crop', 'FilesController@crop')->name('files.crop');

    // 用户相关路由
    Route::resource('users', 'UsersController');
    Route::get('users/password/reset/{user}', 'UsersController@resetPassword')->name('password.request');
    Route::patch('users/password/reset/{user}', 'UsersController@resetPassword')->name('password.reset');
    Route::get('users/{user}/avatar', 'UsersController@avatar')->name('avatar.request');
    Route::get('users/{user}/avatar/crop', 'UsersController@crop')->name('avatar.crop');
    Route::post('users/{user}/avatar/crop', 'UsersController@crop')->name('avatar.cropper');
});
