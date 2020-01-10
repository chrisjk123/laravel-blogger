<?php

namespace Chriscreates\Blog\Listeners;

use Chriscreates\Blog\Events\PostViewed;

class StoreViewData
{
    /**
     * Handle the event.
     *
     * @param PostViewed $event
     * @return void
     */
    public function handle(PostViewed $event)
    {
        logger('something happened.');
    }
}
