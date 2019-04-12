<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @property string $sms_key 短信验证键
 * @property string $sms_code 短信验证码
 * @property string $name 用户名
 * @property string $password 密码
 * @property int $avatar_file_id 头像文件 ID
 */
class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'sms_key' => 'required|string',
                    'sms_code' => 'required|string',
                    'name' => 'required|string|between:3,60',
                    'password' => 'required|string|between:6,20',
                ];
                break;
            case 'PATCH':
                $userId = Auth::guard('api')->id();
                $groupId = 3;

                return [
                    'name' => 'between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . $userId,
                    'email' => 'email',
                    'introduction' => 'max:80',
                    'avatar_file_id' => 'exists:files,id,group_id,' . $groupId . ',user_id,' . $userId,
                ];
                break;
        }
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'sms_key' => '短信验证键',
            'sms_code' => '短信验证码',
            'introduction' => '个人简介',
            'avatar_file_id' => '头像文件',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.require' => '用户名 已被占用，请重新填写。',
            'name.regex' => '用户名 只支持英文、数字、中划线和下划线。',
            'name.between' => '用户名 必须介于 3 - 25 个字符之间。',
            'name.required' => '用户名 不能为空。',
        ];
    }
}
