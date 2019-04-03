<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\SmsCaptchaRequest;
use Illuminate\Support\Facades\Cache;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class SmsCaptchasController extends ApiController
{
    public function store(SmsCaptchaRequest $request, EasySms $easySms)
    {
        if (empty($data = Cache::get($request->captcha_key))) {
            return $this->response->error('图片验证码失效', 422);
        }

        if (! hash_equals($data['code'], $request->captcha_code)) {
            Cache::forget($request->captcha_key);
            return $this->response->errorUnauthorized('图片验证码错误');
        }
        $phone = $data['phone'];

        if (app()->isLocal()) {
            $code = '123456';
        } else {
            $code = random_int(100000, 999999);
            $content = "【小禾社区】您的验证码是{$code}。如非本人操作，请忽略本短信";

            try {
                $result = $easySms->send($phone, ['content' => $content]);
            } catch (NoGatewayAvailableException $e) {
                $raw = $e->getLastException()->raw;
                return $this->response->error($raw['msg'], $raw['http_status_code']);
            }
        }
        $key = 'sms:captcha:' . strtolower(str_random());
        $expiredAt = now()->addMinutes(10);
        Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);
        Cache::forget($request->captcha_key);

        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
