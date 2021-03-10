<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\File;
use App\Models\User;
use App\Transformers\UserTransformer;
use Auth;
use Cache;

class UsersController extends ApiController
{
    public function activeIndex(User $user): Response
    {
        return $this->response->collection($user->getActiveUsers(), new UserTransformer());
    }

    public function store(UserRequest $request): Response
    {
        if (empty($data = Cache::get($request->sms_key))) {
            $this->response->error('验证码已失效', 422);
        }

        if (! hash_equals((string) $data['code'], $request->sms_code)) {
            $this->response->errorUnauthorized('验证码错误');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $data['phone'],
            'password' => bcrypt($request->password),
        ]);
        Cache::forget($request->sms_key);

        return $this->response
            ->item($user, new UserTransformer())
            ->setMeta([
                'access_token' => Auth::guard('api')->fromUser($user),
                'token_type' => 'Bearer',
                'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
            ])
            ->setStatusCode(201);
    }

    public function update(UserRequest $request): Response
    {
        $user = $this->user();
        $attributes = $request->only(['name', 'email', 'introduction', 'registration_id']);

        if ($request->avatar_file_id) {
            $file = File::find($request->avatar_file_id);
            $attributes['avatar'] = $file->uri;
        }
        $user->update($attributes);

        return $this->response->item($user, new UserTransformer());
    }

    public function me(): Response
    {
        return $this->response->item($this->user(), new UserTransformer());
    }
}
