<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ResponseTrait;
use App\Http\Requests\Api\SmsCaptchaRequest;
use Cache;
use Illuminate\Support\Str;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class SmsCaptchasController extends ApiController
{
    use ResponseTrait;

    public function store(SmsCaptchaRequest $request, EasySms $easySms)
    {
        if (empty($data = Cache::get($request->captcha_key))) {
            return $this->toFailure('图片验证码失效', 422);
        }

        if (! hash_equals($data['code'], $request->captcha_code)) {
            Cache::forget($request->captcha_key);
            return $this->toFailure('图片验证码错误', 403);
        }
        $phone = $data['phone'];

        if (app()->isLocal()) {
            $code = '123456';
        } else {
            $code = random_int(100000, 999999);
            $content = "【XX社区】您的验证码是{$code}。如非本人操作，请忽略本短信";

            try {
                $easySms->send($phone, ['content' => $content]);
            } catch (NoGatewayAvailableException $e) {
                $raw = $e->getLastException()->raw;
                return $this->toFailure($raw['msg'], $raw['http_status_code']);
            }
        }
        $key = 'sms:captcha:' . strtolower(Str::random());
        $expiredAt = now()->addMinutes(10);
        Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);
        Cache::forget($request->captcha_key);

        return $this->toSuccess([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
