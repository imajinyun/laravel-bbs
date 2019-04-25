<?php

namespace App\Supports;

use App\Models\Role;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Access\Gate;

class Permission
{
    protected $gate;

    protected $permissionClass;

    protected $roleClass;

    public function __construct(Gate $gate)
    {
        $this->gate = $gate;
        $this->permissionClass = \App\Models\Permission::class;
        $this->roleClass = Role::class;
    }

    public function registerPermissions(): bool
    {
        $this->gate->before(static function (Authorizable $user, string $ability) {
            try {
                if (method_exists($user, 'hasPermissionTo')) {
                    return $user->hasPermissionTo($ability) ?: null;
                }
            } catch (\Exception $e) {
            }
        });

        return true;
    }
}
