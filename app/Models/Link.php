<?php

namespace App\Models;

use Cache;

/**
 * App\Models\Link
 *
 * @property int $id 主键 ID
 * @property string $name 资源名称
 * @property string $href 资源链接
 * @property int $status 资源状态(1:正常 2:停用)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereHref($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Link whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withCreatedAt($direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withUpdatedAt($direction = 'asc')
 * @mixin \Eloquent
 */
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
