<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplyNotification;

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    public function created(Reply $reply)
    {
        $reply->topic->updateReplyCount();
        $reply->topic->user->notify(new TopicReplyNotification($reply));
    }

    public function deleted(Reply $reply)
    {
        $reply->topic->updateReplyCount();
    }
}
