<?php

namespace App\Http\Requests\Api;

/**
 * @property string $content 回复内容
 */
class ReplyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required|min:3',
        ];
    }
}
