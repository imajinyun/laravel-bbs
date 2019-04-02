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
    ], static function (Router $api) {
        $api->post('codes/sms', 'CodesController@smsStore')->name('api.codes.sms.store');
        $api->post('users', 'UsersController@store')->name('api.users.store');
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
