<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Auth'], static function () {
    // 用户登录登出相关路由
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // 用户注册相关路由
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');

    // 密码重置相关路由
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');

    // 邮箱认证相关路由
    Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
});

Route::group(['namespace' => 'Web'], static function () {
    Route::get('/', 'HomeController@homepage')->name('homepage');
    Route::get('home', 'HomeController@index')->name('home.index');
    Route::get('deny', 'HomeController@deny')->name('home.deny');

    // 个人中心相关路由
    Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);

    // 用户话题相关路由
    Route::resource('topics', 'TopicsController', [
        'only' => ['index', 'create', 'store', 'update', 'edit', 'destroy'],
    ]);
    Route::post('upload', 'TopicsController@upload')->name('topics.upload');
    Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

    // 分类相关路由
    Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

    // 话题回复相关路由
    Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

    // 通知相关路由
    Route::resource('notifications', 'NotificationsController', ['only' => 'index']);
});
