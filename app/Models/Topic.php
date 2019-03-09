<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
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
}
