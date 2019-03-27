<?php

namespace App\Models\Traits;

use App\Models\Role;

trait HasRole
{
    use HasPermission;

    /** @var \App\Models\Role */
    private $roleClass;

    public function getRoleClass()
    {
        if (! isset($this->roleClass)) {
            $this->roleClass = app(Role::class);
        }

        return $this->roleClass;
    }

    public function assignRole(...$roles)
    {
        $roles = collect($roles)
            ->flatten()
            ->map(function ($role) {
                if (empty($role)) {
                    return false;
                }

                return $this->getStoredRole($role);
            })
            ->filter(function ($role) {
                return $role instanceof Role;
            })
            ->map->id
            ->all();

        $model = $this->getModel();

        if ($model->exists) {
            /** @var \Illuminate\Database\Eloquent\Relations\BelongsToMany $belongsToMany */
            $belongsToMany = $this->roles();
            $belongsToMany->sync($roles, false);
            $model->load('roles');
        }

        return $this;
    }

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'user_roles',
            'user_id',
            'role_id'
        );
    }

    public function syncRoles(...$roles)
    {
        $this->roles()->detach();

        return $this->assignRole($roles);
    }

    public function hasRole($roles): bool
    {
        if (is_string($roles)) {
            return $this->roles->contains('slug', $roles);
        }

        if ($roles instanceof Role) {
            return $this->roles->contains('id', $roles->id);
        }

        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($role->hasRole($role)) {
                    return true;
                }
            }

            return false;
        }

        return $roles->intersect($this->roles)->isNotEmpty();
    }

    protected function getStoredRole($role): Role
    {
        /** @var \App\Models\Role $roleClass */
        $roleClass = $this->getRoleClass();

        if (is_numeric($role)) {
            return $roleClass::findById($role);
        }

        if (is_string($role)) {
            return $roleClass::findBySlug($role);
        }

        return $role;
    }
}
