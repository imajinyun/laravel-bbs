<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'title' => 'required|min:2',
                        'category_id' => 'required|numeric',
                        'body' => 'required|min:3|max:65535',
                    ];
                }
            case 'GET':
            case 'DELETE':
            default:
                return [];
        }
    }

    /**
     * Prompt information after a violation of the non-rule.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.min' => '标题 必须至少两个字符。',
            'category_id.required' => '分类 必须选择。',
            'category_id.numeric' => '分类 必须为数字。',
            'body.required' => '内容 不能为空。',
            'body.min' => '内容 必须至少三个字符。',
            'body.max' => '内容 太长或者上传了超大图片（超大图片请裁剪后上传）。',
        ];
    }
}
