<?php

namespace App\Handlers;

use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;

class SlugTranslateHandler
{
    /**
     * Create a new handler instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function translate($text): ?string
    {
        $client = new Client();
        $service = $this->getTranslateService();
        $url = $service['url'] . '?';

        $isBaidu = $service['driver'] === 'baidu';
        $salt = time();
        $sign = md5($service['key'] . $text . $salt . $service['secret']);
        $args = [
            'q' => $text,
            'from' => $isBaidu ? 'zh' : 'zh-CHS',
            'to' => $isBaidu ? 'en' : 'EN',
            $isBaidu ? 'appid' : 'appKey' => $service['key'],
            'salt' => $salt,
            'sign' => $sign,
        ];
        $query = http_build_query($args);
        $response = $client->get($url . $query);
        $result = json_decode($response->getBody(), true);

        if ($isBaidu) {
            $text = $result['trans_result'][0]['dst'] ?: '';
        } else {
            $text = $result['translation'][0] ?: '';
        }

        return str_slug($text);
    }

    private function getTranslateService(): array
    {
        $driver = config('services.translate.driver', 'baidu');

        $url = config("services.translate.{$driver}.url");
        $key = config("services.translate.{$driver}.key");
        $secret = config("services.translate.{$driver}.secret");

        return [
            'driver' => $driver,
            'url' => $url,
            'key' => $key,
            'secret' => $secret,
        ];
    }
}
