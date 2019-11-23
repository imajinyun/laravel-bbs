<?php

namespace App\Observers;

use App\Models\Link;
use Cache;

class LinkObserver
{
    /**
     * @param \App\Models\Link $link
     */
    public function saved(Link $link): void
    {
        Cache::forget($link::$cacheKey);
    }
}
