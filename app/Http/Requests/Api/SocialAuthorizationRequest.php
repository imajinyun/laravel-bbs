<?php

namespace App\Http\Requests\Api;

/**
 * @property string $code 授权码
 * @property string $access_token 访问令牌
 * @property string $openid 微信 OpenID
 */
class SocialAuthorizationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'code' => 'required_without:access_token|string',
            'access_token' => 'required_without:code|string',
        ];

        if ($this->social_type === 'weixin' && ! $this->code) {
            $rules['openid'] = 'required|string';
        }

        return $rules;
    }
}
