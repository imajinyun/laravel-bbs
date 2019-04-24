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

    // 系统相关路由
    Route::group(['namespace' => 'System', 'as' => 'systems.'], static function () {

        // 站点设置
        Route::get('systems/sites', 'SitesController@index')->name('sites.index');
        Route::put('systems/sites/update', 'SitesController@update')->name('sites.update');

        // 用户设置
        Route::get('systems/users/register', 'UsersController@register')->name('users.register');
        Route::get('systems/users/login', 'UsersController@login')->name('users.login');

        // 友情链接
        Route::resource('systems/links', 'LinksController');

        // 系统自检
        Route::get('systems/inspections', 'InspectionsController@index')->name('inspections.index');
        Route::get('systems/inspections/status/php', 'InspectionsController@php')->name('inspections.php');

        // 系统命令
        Route::get('systems/artisans', 'ArtisansController@index')->name('artisans.index');
        Route::post('systems/artisans', 'ArtisansController@index')->name('artisans.output');
    });

});
