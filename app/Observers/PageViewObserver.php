<?php

namespace App\Observers;

use App\Events\PageViewed;
use App\Models\PageView;

class PageViewObserver
{
    /**
     * Handle the PageView "created" event.
     */
    public function created(PageView $pageView): void
    {
        broadcast(new PageViewed($pageView));
    }

    /**
     * Handle the PageView "updated" event.
     */
    public function updated(PageView $pageView): void
    {
        //
    }

    /**
     * Handle the PageView "deleted" event.
     */
    public function deleted(PageView $pageView): void
    {
        //
    }

    /**
     * Handle the PageView "restored" event.
     */
    public function restored(PageView $pageView): void
    {
        //
    }

    /**
     * Handle the PageView "force deleted" event.
     */
    public function forceDeleted(PageView $pageView): void
    {
        //
    }
}
