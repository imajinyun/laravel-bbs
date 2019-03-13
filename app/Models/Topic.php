<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * @method withOrder(Builder $builder, $order = null)
 */
class Topic extends Model
{
    protected $fillable = [
        'title',
        'body',
        'category_id',
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

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function link(array $args = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $args));
    }

    public function updateReplyCount()
    {
        $this->reply_count = $this->replies->count();
        $this->save();
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
