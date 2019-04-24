<?php

namespace App\Policies;

use App\Models\Topic;
use App\Models\User;

class TopicPolicy extends Policy
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

    public function update(User $user, Topic $topic): bool
    {
        return $user->isAuthorSelf($topic);
    }

    public function destroy(User $user, Topic $topic): bool
    {
        return $user->isAuthorSelf($topic);
    }
}
