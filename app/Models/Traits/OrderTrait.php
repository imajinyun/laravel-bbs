<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait OrderTrait
{
    public function scopeWithCreatedAt(Builder $builder, $direction = 'asc')
    {
        return $builder->orderBy('created_at', $direction);
    }

    public function scopeWithUpdatedAt(Builder $builder, $direction = 'asc')
    {
        return $builder->orderBy('updated_at', $direction);
    }
}
