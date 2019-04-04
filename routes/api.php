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
    });

    $api->group([
        'middleware' => 'api.throttle',
        'expires' => config('api.rate_limits.access.expires'),
        'limit' => config('api.rate_limits.access.limit'),
    ], static function (Router $api) {

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
