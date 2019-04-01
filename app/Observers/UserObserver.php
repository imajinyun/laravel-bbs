<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function saving(User $user)
    {
        if (empty($user->avatar)) {
            $user->avatar = 'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/Eiyoo9ohthie9ahl.jpg';
        }
    }
}
