<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ImageCaptchaRequest;
use Cache;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Str;

class ImageCaptchasController extends ApiController
{
    public function store(ImageCaptchaRequest $request, CaptchaBuilder $builder)
    {
        $key = 'image:captcha:' . strtolower(Str::random());
        $phone = $request->phone;

        $captcha = $builder->build();
        $expiredAt = now()->addMinutes(3);
        Cache::put($key, ['phone' => $phone, 'code' => $captcha->getPhrase()], $expiredAt);

        $result = [
            'captcha_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
            'captcha_src' => $captcha->inline(),
        ];

        return response()->json($result)->setStatusCode(201);
    }
}
