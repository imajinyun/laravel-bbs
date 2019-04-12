<?php

namespace App\Http\Requests\Api;

/**
 * @property string $captcha_key 验证键
 * @property string $captcha_code 验证码
 */
class SmsCaptchaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'captcha_key' => 'required|string',
            'captcha_code' => 'required|string',
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
            'captcha_key' => '图片验证键',
            'captcha_code' => '图片验证码',
        ];
    }
}
