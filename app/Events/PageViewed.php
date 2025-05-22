<?php

namespace App\Events;

use App\Models\PageView;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PageViewed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public PageView $pageView;

    /**
     * Create a new event instance.
     */
    public function __construct(PageView $pageView)
    {
        $this->pageView = $pageView;
    }

    public function broadcastOn(): Channel
    {
        return new PresenceChannel('pixel');
    }

    public function broadcastAs(): string
    {
        return 'PageViewed';
    }
}
