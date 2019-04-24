<?php

namespace App\Observers;

use App\Jobs\SlugTranslateJob;
use App\Models\Topic;
use DB;

class TopicObserver
{
    public function saving(Topic $topic)
    {
        $topic->body = clean($topic->body, 'user_topic_body');
        $topic->excerpt = make_excerpt($topic->body);
    }

    public function saved(Topic $topic)
    {
        if (! $topic->slug) {
            dispatch(new SlugTranslateJob($topic));
        }
    }

    public function deleted(Topic $topic)
    {
        DB::table('replies')
            ->where('topic_id', $topic->id)
            ->delete();
    }
}
