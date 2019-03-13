<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;

class ReplyPolicy extends Policy
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

    public function update(User $user, Topic $topic)
    {
        return $user->isAuthorSelf($topic);
    }

    public function destroy(User $user, Reply $reply)
    {
        return $user->isAuthorSelf($reply) || $user->isAuthorSelf($reply->topic);
    }
}
