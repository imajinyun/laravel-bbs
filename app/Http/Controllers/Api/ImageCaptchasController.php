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
        $key = 'image:captcha:'.strtolower(Str::random());
        $captcha = $builder->build();
        $expiredAt = now()->addMinutes(3);
        [$phone, $code] = [$request->phone, $captcha->getPhrase()];
        Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);

        $result = [
            'captcha_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
            'captcha_src' => $captcha->inline(),
        ];
        if (app()->isLocal()) {
            $result['captcha_value'] = $code;
        }

        return response()->json($result)->setStatusCode(201);
    }
}
