<?php

namespace App\Models;

/**
 * App\Models\FileGroups
 *
 * @property int $id 主键 ID
 * @property string $name 分组名称
 * @property string $code 分组代码
 * @property int $is_public 是否公开(0:否 1:是)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileGroups newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileGroups newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileGroups query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileGroups whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileGroups whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileGroups whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileGroups whereIsPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileGroups whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FileGroups whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withCreatedAt($direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withUpdatedAt($direction = 'asc')
 * @mixin \Eloquent
 */
class FileGroups extends Model
{
    //
}
