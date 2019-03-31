<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;

class Link extends Model
{
    public static $cacheKey = 'bbs:links';

    protected static $cacheExpiredTime = 1440;

    protected $fillable = ['name', 'href'];

    public function getCacheLinks()
    {
        return Cache::remember(self::$cacheKey, self::$cacheExpiredTime, function () {
            return $this->all();
        });
    }
}
