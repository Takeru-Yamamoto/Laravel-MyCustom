<?php

namespace MyCustom\Utils\Time;

use MyCustom\Jsonables\BaseJsonable;

final class TimeUtil extends BaseJsonable
{
    private float $processTime;
    private float $processStart;
    private float $processStop;

    final public function start(): static
    {
        $this->processStart = microtime(true);

        return $this;
    }

    final public function stop(): static
    {
        $this->processStop = microtime(true);
        $this->processTime = $this->processStop - $this->processStart;

        return $this;
    }

    final public function getProcessTime(): float
    {
        return $this->processTime;
    }

    final public function getProcessStart(): float
    {
        return $this->processStart;
    }

    final public function getProcessStop(): float
    {
        return $this->processStop;
    }
}
