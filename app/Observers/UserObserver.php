<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * @param \App\Models\User $user
     */
    public function saving(User $user): void
    {
        if (empty($user->avatar)) {
            $user->avatar = '/laravel/bbs/avatar/Eiyoo9ohthie9ahl.jpg';
        }
    }
}
