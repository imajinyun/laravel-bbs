<?php

namespace App\Models;

use App\Models\Traits\HasPermission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasPermission;

    protected $fillable = ['name'];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'role_permissions',
            'role_id',
            'permission_id'
        );
    }

    public static function findById(string $id)
    {
        return static::where('id', '=', $id)->first();
    }

    public static function findBySlug(string $slug)
    {
        return static::where('slug', '=', $slug)->first();
    }

}
