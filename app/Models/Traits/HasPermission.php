<?php

namespace App\Models\Traits;

use App\Exceptions\PermissionDoesNotExist;
use App\Models\Permission;

trait HasPermission
{
    /** @var \App\Models\Permission */
    private $permissionClass;

    public static function bootHasPermissions()
    {
        static::deleting(function ($model) {
            if (method_exists($model, 'isForceDeleting') && ! $model->isForceDeleting()) {
                return;
            }

            $model->permissions()->detach();
        });
    }

    public function getPermissionClass()
    {
        if (! isset($this->permissionClass)) {
            $this->permissionClass = app(Permission::class);
        }

        return $this->permissionClass;
    }

    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'role_permissions',
            'permission_id',
            'role_id'
        );
    }

    public function hasPermissionTo($value)
    {
        $permissionClass = $this->getPermissionClass();
        $permission = null;

        if (is_string($value)) {
            $permission = $permissionClass::findBySlug($value);
        }

        if (is_int($value)) {
            $permission = $permissionClass::findById($value);
        }

        if (! $permission instanceof Permission) {
            throw new \InvalidArgumentException('Invalid permission parameter.');
        }

        return $this->hasDirectPermission($permission) || $this->hasPermissionViaRole($permission);
    }

    public function hasDirectPermission($permission): bool
    {
        $permissionClass = $this->getPermissionClass();

        if (is_string($permission)) {
            $permission = $permissionClass::findBySlug($permission);

            if (! $permission) {
                return false;
            }
        }

        if (is_int($permission)) {
            $permission = $permissionClass::findById($permission);

            if (! $permission) {
                return false;
            }
        }

        if (! $permission instanceof Permission) {
            return false;
        }

        return $this->permissions->contains('id', $permission->id);
    }

    public function givePermissionTo(...$permissions)
    {
        $permissions = collect($permissions)
            ->flatten()
            ->map(function ($permission) {
                if (empty($permission)) {
                    return false;
                }

                return $this->getStoredPermission($permission);
            })
            ->filter(function ($permission) {
                return $permission instanceof Permission;
            })
            ->map->id
            ->all();
        $model = $this->getModel();

        if ($model->exists) {
            $this->permissions()->sync($permissions, false);
            $this->load('permissions');
        }
    }

    public function revokePermissionTo($permission)
    {
        $this->permissions()->detach($this->getStoredPermission($permission));
        $this->load('permissions');

        return $this;
    }

    public function getStoredPermission($permissions)
    {
        /** @var \App\Models\Permission $permissionClass */
        $permissionClass = $this->getPermissionClass();

        if (is_numeric($permissions)) {
            return $permissionClass::findById($permissions);
        }

        if (is_string($permissions)) {
            return $permissionClass::findByName($permissions);
        }

        if (is_array($permissions)) {
            return $permissionClass
                ->whereIn('id', $permissions)
                ->get();
        }

        return $permissions;
    }

    protected function hasPermissionViaRole(Permission $permission): bool
    {
        return $this->hasRole($permission->roles);
    }
}
