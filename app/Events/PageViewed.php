<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PageViewed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $url;
    public string $viewed_at;
    public string $referrer;

    /**
     * Create a new event instance.
     */
    public function __construct($url, $referrer, $view_at)
    {
        $this->url = $url;
        $this->referrer = $referrer;
        $this->viewed_at = $view_at;
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
