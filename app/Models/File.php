<?php

namespace App\Models;

/**
 * App\Models\File
 *
 * @property int $id 主键 ID
 * @property int $group_id 分组 ID，关联 file_groups 表主键 ID
 * @property int $user_id 用户 ID，关联 users 表主键 ID
 * @property string $uri 文件 URI
 * @property string $mime 文件 MIME
 * @property int $size 文件大小
 * @property int $status 文件状态(1:正常 2:禁用)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withCreatedAt($direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withUpdatedAt($direction = 'asc')
 * @mixin \Eloquent
 */
class File extends Model
{
    //
}
