<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CodeRequest;
use Illuminate\Support\Facades\Cache;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class CodesController extends ApiController
{
    public function smsStore(CodeRequest $request, EasySms $easySms)
    {
        $phone = $request->phone;

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
        $key = 'sms:verification:' . strtolower(str_random());
        $expiredAt = now()->addMinutes(10);
        Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);

        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
