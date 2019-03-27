<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $fillable = ['name'];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'role_permissions',
            'permission_id',
            'role_id'
        );
    }

    public static function findById(int $id)
    {
        return static::where('id', $id)->first();
    }

    public static function findBySlug(string $slug)
    {
        return static::where('slug', $slug)->first();
    }
}
