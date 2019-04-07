<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;

class TopicRequest extends FormRequest
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
            'title' => 'required|string|min:2',
            'body' => 'required|string|min:3|max:65535',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => '话题标题',
            'body' => '话题内容',
            'category_id' => '话题分类',
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
            'title.min' => '标题 必须至少两个字符。',
            'body.required' => '内容 不能为空。',
            'body.min' => '内容 必须至少三个字符。',
            'body.max' => '内容 太长或者上传了超大图片（超大图片请裁剪后上传）。',
            'category_id.required' => '分类 必须选择。',
        ];
    }
}
