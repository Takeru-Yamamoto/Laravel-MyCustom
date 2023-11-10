<?php

namespace MyCustom\Utils\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \MyCustom\Utils\Logging\LoggingUtil make(\MyCustom\Utils\Logging\Enums\LogLevelEnum $logLevel)
 * 
 * @method static \MyCustom\Utils\Logging\LoggingUtil debug()
 * @method static \MyCustom\Utils\Logging\LoggingUtil info()
 * @method static \MyCustom\Utils\Logging\LoggingUtil notice()
 * @method static \MyCustom\Utils\Logging\LoggingUtil warning()
 * @method static \MyCustom\Utils\Logging\LoggingUtil error()
 * @method static \MyCustom\Utils\Logging\LoggingUtil critical()
 * @method static \MyCustom\Utils\Logging\LoggingUtil alert()
 * @method static \MyCustom\Utils\Logging\LoggingUtil emergency()
 * 
 * @method static void debugLog(mixed $message, mixed $value = null)
 * @method static void infoLog(mixed $message, mixed $value = null)
 * @method static void noticeLog(mixed $message, mixed $value = null)
 * @method static void warningLog(mixed $message, mixed $value = null)
 * @method static void errorLog(mixed $message, mixed $value = null)
 * @method static void criticalLog(mixed $message, mixed $value = null)
 * @method static void alertLog(mixed $message, mixed $value = null)
 * @method static void emergencyLog(mixed $message, mixed $value = null)
 * 
 * @see \MyCustom\Utils\Facades\Managers\LoggingUtilManager
 */
class Logging extends Facade
{
    /** 
     * Get the registered name of the component. 
     * 
     * @return string 
     */
    protected static function getFacadeAccessor()
    {
        return "LoggingUtil";
    }
}
