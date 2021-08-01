<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\File;
use App\Models\User;
use App\Transformers\UserTransformer;
use Cache;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersController extends ApiController
{
    public function activeIndex(User $user): JsonResource
    {
        return $this->response->collection($user->getActiveUsers(), new UserTransformer());
    }

    public function store(UserRequest $request)
    {
        if (empty($data = Cache::get($request->sms_key))) {
            abort(403, '验证码已失效');
        }

        if (! hash_equals((string) $data['code'], $request->sms_code)) {
            throw new AuthenticationException('验证码错误');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $data['phone'],
            'password' => bcrypt($request->password),
        ]);
        Cache::forget($request->sms_key);

        return new UserResource($user);
    }

    public function update(UserRequest $request): JsonResource
    {
        $user = $request->user();
        $attributes = $request->only(['name', 'email', 'introduction', 'registration_id']);

        if ($request->avatar_file_id) {
            $file = File::find($request->avatar_file_id);
            $attributes['avatar'] = $file->uri;
        }
        $user->update($attributes);

        return new UserResource($user);
    }

    public function me(Request $request): JsonResource
    {
        return new UserResource($request->user());
    }
}
