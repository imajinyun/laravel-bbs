<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplyNotification;

class ReplyObserver
{
    /**
     * @param \App\Models\Reply $reply
     */
    public function creating(Reply $reply): void
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    /**
     * @param \App\Models\Reply $reply
     */
    public function created(Reply $reply): void
    {
        $topic = $reply->topic;
        $topic->updateReplyCount();
        $topic->user->inform(new TopicReplyNotification($reply));
    }

    /**
     * @param \App\Models\Reply $reply
     */
    public function deleted(Reply $reply): void
    {
        $reply->topic->updateReplyCount();
    }
}
