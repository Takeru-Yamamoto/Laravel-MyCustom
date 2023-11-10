<?php

namespace MyCustom\Utils\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \MyCustom\Utils\Time\TimeUtil make()
 * @method static \MyCustom\Utils\Time\TimeUtil start()
 * 
 * @see \MyCustom\Utils\Facades\Managers\TimeUtilManager
 */
class Time extends Facade
{
    /** 
     * Get the registered name of the component. 
     * 
     * @return string 
     */
    protected static function getFacadeAccessor()
    {
        return "TimeUtil";
    }
}
