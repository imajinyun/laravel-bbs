<?php

namespace App\Models;

use App\Models\Traits\OrderTrait;
use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * App\Models\Model
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withCreatedAt($direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withUpdatedAt($direction = 'asc')
 * @mixin \Eloquent
 */
class Model extends EloquentModel
{
    use OrderTrait;
}
