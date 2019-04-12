<?php

namespace App\Http\Requests\Api;

/**
 * @property string $username 用户名
 * @property string $password 密码
 */
class AuthorizationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ];
    }
}
