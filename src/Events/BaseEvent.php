<?php

namespace MyCustom\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;

use MyCustom\Utils\Facades\Logging;

abstract class BaseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected bool $isLogging = false;

    public static function publish(...$arguments): void
    {
        $event = new static(...$arguments);

        $className = className($event);

        $loggingUtil = Logging::info();

        $loggingUtil->addEmphasis("EVENT " . $className . " PUBLISHING START");

        event($event);

        $loggingUtil->add("EVENT " . $className . " IS PUBLISHED");

        $loggingUtil->addEmphasis("EVENT " . $className . " PUBLISHING END");

        if ($event->isLogging) $loggingUtil->logging();
    }
}
