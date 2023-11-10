<?php

namespace MyCustom\Events;

use MyCustom\Events\BaseEvent;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

abstract class BaseBroadcastEvent extends BaseEvent implements ShouldBroadcast
{
    public string $channelName;

    public function broadcastOn(): Channel
    {
        return new Channel($this->channelName);
    }
}
