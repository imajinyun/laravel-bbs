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

    public static function findByName(string $name)
    {
        return static::where('name', '=', $name)->first();
    }
}
