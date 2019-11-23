<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    /**
     * @param \App\Models\User $user
     * @param string $ability
     *
     * @return bool
     */
    public function before($user, $ability): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return false;
    }
}
