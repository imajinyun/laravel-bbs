<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy extends Policy
{
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param \App\Models\User $currentUser
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function update(User $currentUser, User $user): bool
    {
        return (int) $currentUser->id === (int) $user->id;
    }
}
