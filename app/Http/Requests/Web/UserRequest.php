<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:120',
            'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
        ];
    }

    /**
     * Prompt information after a violation of the non-rule.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique' => '用户名 已被占用，请重新填写。',
            'name.regex' => '用户名 只支持英文、数字、中划线和下划线。',
            'name.between' => '用户名 必须介于 3 - 25 个字符之间。',
            'name.required' => '用户名 不能为空。',
            'avatar.mimes' => '头像 必须是 jpeg, bmp, png, gif 格式的图片。',
            'avatar.dimensions' => '头像 的清晰度不够，宽和高需要 200px 以上。',
        ];
    }
}
