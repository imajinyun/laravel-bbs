<?php

namespace App\Http\Requests\Api;

/**
 * @property string $phone 手机号码
 */
class ImageCaptchaRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => [
                'required',
                'regex:/^(?=\d{11}$)^1(?:3\d|4[57]|5[^4\D]|7[^249\D]|8\d)\d{8}$/',
                'unique:users',
            ],
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
            'phone.required' => '手机号 不能为空。',
            'phone.regex' => '手机号 格式不正确。',
            'phone.unique' => '手机号 已经存在。',
        ];
    }
}
