<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthorizationRequest;
use App\Http\Requests\Api\SocialAuthorizationRequest;
use App\Models\User;
use Auth;
use Socialite;

class AuthorizationsController extends ApiController
{
    public function store(AuthorizationRequest $request)
    {
        $username = $request->username;

        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['phone'] = $username;
        $credentials['password'] = $request->password;

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            $this->response->errorUnauthorized(trans('auth.failed'));
        }

        return $this->responseWithToken($token)->setStatusCode(201);
    }

    public function socialStore(string $type, SocialAuthorizationRequest $request)
    {
        if (! in_array($type, ['weixin', 'weibo'], true)) {
            $this->response->errorBadRequest();
        }

        $driver = Socialite::driver($type);
        try {
            if ($code = $request->code) {
                $response = $driver->getAccessTokenResponse($code);
                $token = $response['access_token'];
            } else {
                $token = $request->access_token;

                if ($type === 'weixin') {
                    $driver->setOpenId($request->openid);
                }
            }
            $oauth = $driver->userFromToken($token);
        } catch (\Exception $e) {
            $this->response->errorUnauthorized('参数错误');
        }

        $user = null;
        switch ($type) {
            case 'weixin':
                $unionid = $oauth->offsetExists('unionid') ? $oauth->offsetGet('unionid') : null;
                if ($unionid) {
                    $user = User::where('weixin_unionid', $unionid)->first();
                } else {
                    $user = User::where('weixin_openid', $oauth->getId())->first();
                }

                if (! $user) {
                    $user = User::create([
                        'name' => $oauth->getNickname(),
                        'avatar' => $oauth->getAvatar(),
                        'weixin_openid' => $oauth->getId(),
                        'weixin_unionid' => $unionid,
                    ]);
                }
                break;
            case 'weibo':
                break;
            default:
                break;
        }

        $token = Auth::guard('api')->fromUser($user);

        return $this->responseWithToken($token)->setStatusCode(201);
    }

    public function update()
    {
        $token = Auth::guard('api')->refresh();

        return $this->responseWithToken($token);
    }

    public function destroy(): Response
    {
        Auth::guard('api')->logout();

        return $this->response->noContent();
    }

    protected function responseWithToken($token): Response
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
        ]);
    }
}
