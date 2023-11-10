<?php

namespace MyCustom\Utils\Facades\Managers;

use MyCustom\Utils\Time\TimeUtil;

class TimeUtilManager
{
    public function make(): TimeUtil
    {
        return new TimeUtil();
    }

    public function start(): TimeUtil
    {
        return $this->make()->start();
    }
}
