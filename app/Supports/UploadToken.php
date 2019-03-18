<?php

namespace App\Supports;

use Illuminate\Support\Facades\Auth;

class UploadToken
{
    public function make($group, $type = 'image', $duration = 14400)
    {
        $user = Auth::user();
        $duration = now()->addSeconds($duration);
        $secret = config('app.key');
        $key = "{$user->id}|{$group}|{$type}|{$duration}";
        $sign = md5("{$key}|{$secret}");

        return $this->base64Encode("{$key}|{$sign}");
    }

    public function parse($token)
    {
        $token = $this->base64Decode($token);

        if (! $token) {
            return null;
        }

        list($userId, $group, $type, $deadline, $sign) = explode('|', $token);

        if ($deadline < now()) {
            return null;
        }

        $secret = config('app.key');
        $expectedSign = md5("{$userId}|{$group}|{$type}|{$deadline}|{$secret}");

        if ($sign !== $expectedSign) {
            return null;
        }

        return [
            'user_id' => $userId,
            'group' => $group,
            'type' => $type,
        ];
    }

    private function base64Encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64Decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}
