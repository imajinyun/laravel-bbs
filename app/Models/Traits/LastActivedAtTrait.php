<?php

namespace App\Models\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

trait LastActivedAtTrait
{
    /** @var string 缓存的键名 */
    protected static $cacheLastActivedAtKey = 'bbs:last_active_at:';

    /** @var string 缓存的字段前缀 */
    protected static $cacheFieldPrefix = 'user_';

    public function logLastActivedAt(): void
    {
        $hash = self::getHashFromDateString(now()->toDateString());
        $field = self::getHashField();
        Redis::hSet($hash, $field, now()->toDateTimeString());
    }

    public function syncLastActivedAt(): void
    {
        $hash = self::getHashFromDateString(now()::yesterday()->toDateString());
        $dates = Redis::hGetAll($hash);

        foreach ($dates as $uid => $at) {
            $userId = str_replace(self::$cacheFieldPrefix, '', $uid);

            if ($user = static::find($userId)) {
                $user->last_actived_at = $at;
                $user->save();
            }
        }
        Redis::del($hash);
    }

    public function getLastActivedAtAttribute($value)
    {
        $hash = self::getHashFromDateString(now()->toDateString());
        $field = self::getHashField();
        $datetime = Redis::hGet($hash, $field) ?: $value;

        return $datetime ? new Carbon($datetime) : $this->created_at;
    }

    private static function getHashFromDateString($date): string
    {
        return self::$cacheLastActivedAtKey . $date;
    }

    private static function getHashField(): string
    {
        return self::$cacheFieldPrefix . Auth::id();
    }
}
