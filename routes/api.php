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
    'middleware' => 'serializer:array',
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

        // 游客可以访问的接口

        // 需要 Token 认证的接口
        $api->group(['middleware' => 'api.auth'], static function (Router $api) {

            // 获取当前用户信息
            $api->get('user', 'UsersController@me')->name('api.user.show');

            // 更新当前用户信息
            $api->patch('user', 'UsersController@update')->name('api.user.update');

            // 图片资源
            $api->post('images', 'ImagesController@store')->name('api.image.store');
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
