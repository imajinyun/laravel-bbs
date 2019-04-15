<?php

use Dingo\Api\Routing\Router;
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

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => ['serializer:array', 'bindings'],
], static function (Router $api) {
    $api->get('version', static function () {
        return response('this is version 1 api.');
    });

    $api->group([
        'middleware' => 'api.throttle',
        'expires' => config('api.rate_limits.sign.expires'),
        'limit' => config('api.rate_limits.sign.limit'),
    ], static function (Router $api) {

        // 短信验证码
        $api->post('sms/captchas', 'SmsCaptchasController@store')->name('api.sms.captchas.store');

        // 图片验证码
        $api->post('image/captchas', 'ImageCaptchasController@store')->name('api.image.captchas.store');

        // 用户注册
        $api->post('users', 'UsersController@store')->name('api.users.store');

        // 微信登录
        $api->post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')->name('api.socials.authorizations.store');
        $api->post('authorizations', 'AuthorizationsController@store')->name('api.authorizations.store');
        $api->put('authorizations/current', 'AuthorizationsController@update')->name('api.authorizations.update');
        $api->delete('authorizations/current', 'AuthorizationsController@destroy')->name('api.authorizations.destroy');

        // 需要 Token 认证的接口
        $api->group(['middleware' => 'api.auth'], static function (Router $api) {
        });
    });

    $api->group([
        'middleware' => 'api.throttle',
        'expires' => config('api.rate_limits.access.expires'),
        'limit' => config('api.rate_limits.access.limit'),
    ], static function (Router $api) {

        /** 游客可以访问的接口 */

        // 话题分类列表
        $api->get('categories', 'CategoriesController@index')->name('api.categories.index');

        // 用户话题列表
        $api->get('topics', 'TopicsController@index')->name('api.topics.index');

        // 用户话题详情
        $api->get('topics/{topic}', 'TopicsController@show')->name('api.topics.show');

        // 指定用户话题列表
        $api->get('users/{user}/topics', 'TopicsController@userIndex')->name('api.users.topics.index');

        // 话题回复列表
        $api->get('topics/{topic}/replies', 'RepliesController@index')->name('api.topics.replies.index');

        // 指定用户回复列表
        $api->get('users/{user}/replies', 'RepliesController@userIndex')->name('api.users.replies.index');

        // 资源推荐列表
        $api->get('links', 'LinksController@index')->name('api.links.index');

        // 活跃用户列表
        $api->get('active/users', 'UsersController@activeIndex')->name('api.active.users.index');

        /** 需要 Token 认证的接口 */

        $api->group(['middleware' => 'api.auth'], static function (Router $api) {

            // 当前用户信息
            $api->get('user', 'UsersController@me')->name('api.user.show');

            // 更新当前用户信息
            $api->patch('user', 'UsersController@update')->name('api.user.update');

            // 上传图片资源
            $api->post('images', 'ImagesController@store')->name('api.image.store');

            // 创建用户话题
            $api->post('topics', 'TopicsController@store')->name('api.topics.store');

            // 更新用户话题
            $api->patch('topics/{topic}', 'TopicsController@update')->name('api.topics.update');

            // 删除用户话题
            $api->delete('topics/{topic}', 'TopicsController@destroy')->name('api.topics.destroy');

            // 用户发布回复
            $api->post('topics/{topic}/replies', 'RepliesController@store')->name('api.topics.replies.store');

            // 删除用户回复
            $api->delete('topics/{topic}/replies/{reply}', 'RepliesController@destroy')->name('api.topics.replies.destroy');

            // 用户通知列表
            $api->get('user/notifications', 'NotificationsController@index')->name('api.user.notifications.index');

            // 用户通知统计
            $api->get('user/notifications/stats', 'NotificationsController@stats')->name('api.user.notifications.stats');

            // 用户通知标记
            $api->patch('user/read/notifications', 'NotificationsController@read')->name('api.user.read.notifications');

            // 当前用户权限
            $api->get('user/permissions', 'PermissionsController@index')->name('api.user.permissions.index');
        });
    });
});

$api->version('v2', static function (Router $api) {
    $api->get('version', static function () {
        return response('this is version 2 api.');
    });
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
