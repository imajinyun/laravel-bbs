<?php

namespace App\Models\Traits;

use App\Models\Permission;

trait HasPermission
{
    private $permissionClass;

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

    public function getStoredPermission($permissions)
    {
        /** @var \App\Models\Permission $permissionClass */
        $permissionClass = $this->getPermissionClass();

        if (is_numeric($permissions)) {
            return $permissionClass::findById($permissions);
        }

        if (is_string($permissions)) {
            return $permissionClass->findByName($permissions);
        }

        if (is_array($permissions)) {
            return $permissionClass
                ->whereIn('name', $permissions)
                ->get();
        }

        return $permissions;
    }
}