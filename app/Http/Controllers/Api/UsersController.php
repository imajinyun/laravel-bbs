<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UsersController extends ApiController
{
    public function store(UserRequest $request)
    {
        if (empty($data = Cache::get($request->sms_key))) {
            return $this->response->error('验证码已失效', 422);
        }

        if (! hash_equals((string) $data['code'], $request->sms_code)) {
            return $this->response->errorUnauthorized('验证码错误');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $data['phone'],
            'password' => bcrypt($request->password),
        ]);
        Cache::forget($request->sms_key);

        return $this->response->created(null, $user);
    }
}
