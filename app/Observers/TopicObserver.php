<?php

namespace App\Observers;

use App\Jobs\SlugTranslateJob;
use App\Models\Topic;
use DB;

class TopicObserver
{
    /**
     * @param \App\Models\Topic $topic
     */
    public function saving(Topic $topic): void
    {
        $topic->body = clean($topic->body, 'user_topic_body');
        $topic->excerpt = make_excerpt($topic->body);
    }

    /**
     * @param \App\Models\Topic $topic
     */
    public function saved(Topic $topic): void
    {
        if (! $topic->slug) {
            dispatch(new SlugTranslateJob($topic));
        }
    }

    /**
     * @param \App\Models\Topic $topic
     */
    public function deleted(Topic $topic): void
    {
        DB::table('replies')
            ->where('topic_id', $topic->id)
            ->delete();
    }
}
