<?php

namespace App\Models;

use App\Models\Traits\OrderTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @method withOrder(Builder $builder, $order = null)
 */
class Topic extends Model
{
    use OrderTrait;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id',
        'last_reply_user_id',
        'reply_count',
        'view_count',
        'sort_value',
        'excerpt',
        'slug',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder(Builder $builder, $order = null)
    {
        if ($order === 'recent') {
            $builder->withCreatedAt('desc');
        } else {
            $builder->withUpdatedAt('desc');
        }

        return $builder->with('user', 'category');
    }
}
