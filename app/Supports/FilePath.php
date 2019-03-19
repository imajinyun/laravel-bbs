<?php

namespace App\Supports;

class FilePath
{
    public static function getFilePath($path, $default = null, $absolute = false)
    {
        if ($path) {
            return $path;
        }

        if ($default) {
            switch ($default) {
                case 'avatar':
                    $filename = '/backend/img/default/user_avatar.png';
                    break;
                case 'thumb':
                    break;
                case 'tmp':
                    break;
                default:
                    break;
            }
        }

        return self::getAppUrl() . $filename;
    }

    private static function parseUri($uri)
    {
        if (false !== strpos($uri, 'http://') || false !== strpos($uri, 'https://')) {
            return $uri;
        }
    }

    public static function getAppUrl()
    {
        return config('app.url');
    }
}
