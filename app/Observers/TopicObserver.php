<?php

namespace App\Observers;

use App\Models\Topic;

class TopicObserver
{
    public function saving(Topic $topic)
    {
        $this->body = clean($topic->body, 'user_topic_body');
        $this->excerpt = make_excerpt($topic->body);
    }
}
