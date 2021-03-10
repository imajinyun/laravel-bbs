<?php

use App\Http\Controllers\Api\ImageCaptchasController;
use App\Http\Controllers\Api\SmsCaptchasController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')
    ->namespace('Api')
    ->name('api.v1.')
    ->group(function () {

    Route::get('version', function () {
        abort(403, 'this is version 1 api');
    })->name('version');

    Route::group([
        // 'middleware' => 'throttle:',
        'expires' => config('api.rate_limits.sign.expires'),
        'limit' => config('api.rate_limits.sign.limit'),
    ], function () {
        // 短信验证码
        Route::post('sms/captchas', [SmsCaptchasController::class, 'store'])
            ->name('api.sms.captchas.store');

        // 图片验证码
        Route::post('image/captchas', [ImageCaptchasController::class, 'store'])
            ->name('api.image.captchas.store');

        // 用户注册
        Route::post('users', [UsersController::class, 'store'])
            ->name('api.users.store');

        // 微信登录
        Route::post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')
            ->name('api.socials.authorizations.store');
        Route::post('authorizations', 'AuthorizationsController@store')
            ->name('api.authorizations.store');
        Route::put('authorizations/current', 'AuthorizationsController@update')
            ->name('api.authorizations.update');
        Route::delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('api.authorizations.destroy');

        // 需要 Token 认证的接口
        Route::group(['middleware' => 'api.auth'], static function () {
        });
    });

    Route::group([
        'middleware' => 'throttle:',
        'expires' => config('api.rate_limits.access.expires'),
        'limit' => config('api.rate_limits.access.limit'),
    ], static function () {

        /** 游客可以访问的接口 */

        // 话题分类列表
        Route::get('categories', 'CategoriesController@index')
            ->name('api.categories.index');

        // 用户话题列表
        Route::get('topics', 'TopicsController@index')
            ->name('api.topics.index');

        // 用户话题详情
        Route::get('topics/{topic}', 'TopicsController@show')
            ->name('api.topics.show');

        // 指定用户话题列表
        Route::get('users/{user}/topics', 'TopicsController@userIndex')
            ->name('api.users.topics.index');

        // 话题回复列表
        Route::get('topics/{topic}/replies', 'RepliesController@index')
            ->name('api.topics.replies.index');

        // 指定用户回复列表
        Route::get('users/{user}/replies', 'RepliesController@userIndex')
            ->name('api.users.replies.index');

        // 资源推荐列表
        Route::get('links', 'LinksController@index')
            ->name('api.links.index');

        // 活跃用户列表
        Route::get('active/users', 'UsersController@activeIndex')
            ->name('api.active.users.index');

        /** 需要 Token 认证的接口 */

        Route::group(['middleware' => 'api.auth'], static function () {

            // 当前用户信息
            Route::get('user', 'UsersController@me')
                ->name('api.user.show');

            // 更新当前用户信息
            Route::patch('user', 'UsersController@update')
                ->name('api.user.update');

            // 上传图片资源
            Route::post('images', 'ImagesController@store')
                ->name('api.image.store');

            // 创建用户话题
            Route::post('topics', 'TopicsController@store')
                ->name('api.topics.store');

            // 更新用户话题
            Route::patch('topics/{topic}', 'TopicsController@update')
                ->name('api.topics.update');

            // 删除用户话题
            Route::delete('topics/{topic}', 'TopicsController@destroy')
                ->name('api.topics.destroy');

            // 用户发布回复
            Route::post('topics/{topic}/replies', 'RepliesController@store')
                ->name('api.topics.replies.store');

            // 删除用户回复
            Route::delete('topics/{topic}/replies/{reply}', 'RepliesController@destroy')
                ->name('api.topics.replies.destroy');

            // 用户通知列表
            Route::get('user/notifications', 'NotificationsController@index')
                ->name('api.user.notifications.index');

            // 用户通知统计
            Route::get('user/notifications/stats', 'NotificationsController@stats')
                ->name('api.user.notifications.stats');

            // 用户通知标记
            Route::patch('user/read/notifications', 'NotificationsController@read')
                ->name('api.user.read.notifications');

            // 当前用户权限
            Route::get('user/permissions', 'PermissionsController@index')
                ->name('api.user.permissions.index');
        });
    });

});

Route::prefix('v2')->name('api.v2.')->group(function () {
    Route::get('version', function () {
        abort(403, 'this is version 2 api');
    })->name('version');
});
