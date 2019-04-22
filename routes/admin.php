<?php

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

Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'middleware' => 'admin'], static function () {

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

    // 角色相关路由
    Route::resource('roles', 'RolesController');
    Route::get('roles/check/name/{id?}', 'RolesController@checkName')->name('roles.check.name');
    Route::get('roles/check/slug/{id?}', 'RolesController@checkSlug')->name('roles.check.slug');

    // 运营相关路由
    Route::resource('operations', 'OperationsController');

    // 权限相关路由
    Route::resource('permissions', 'PermissionsController');
    Route::get('permissions/check/name/{id?}', 'PermissionsController@checkName')->name('permissions.check.name');
    Route::get('permissions/check/slug/{id?}', 'PermissionsController@checkSlug')->name('permissions.check.slug');

    // 设置相关路由
    Route::group(['namespace' => 'Site', 'as' => 'settings.'], static function () {

        // 站点信息
        Route::get('settings/sites/{site?}', 'SitesController@show')->name('sites.show');
        Route::put('settings/sites/update', 'SitesController@update')->name('sites.update');

        // 友情链接
        Route::resource('settings/links', 'LinksController');
    });

    Route::group(['namespace' => 'User', 'as' => 'settings.'], static function () {
        Route::get('settings/users/register', 'UsersController@register')->name('users.register');
        Route::get('settings/users/login', 'UsersController@login')->name('users.login');
    });

    // 系统相关路由
    Route::group(['namespace' => 'System', 'as' => 'systems.'], static function () {

        // 系统自检
        Route::get('inspections', 'InspectionsController@index')->name('inspections.index');
        Route::get('inspections/status/php', 'InspectionsController@php')->name('inspections.php');
    });

});
