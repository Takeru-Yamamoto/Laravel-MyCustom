<?php

namespace MyCustom\Utils\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \MyCustom\Utils\Redirect\RedirectUtil make(string $url)
 * @method static \MyCustom\Utils\Redirect\RedirectUtil previous()
 * @method static \MyCustom\Utils\Redirect\RedirectUtil route(string $route, array $parameters = [], bool $absolute = true)
 * 
 * @see \MyCustom\Utils\Facades\Managers\RedirectUtilManager
 */
class Redirect extends Facade
{
    /** 
     * Get the registered name of the component. 
     * 
     * @return string 
     */
    protected static function getFacadeAccessor()
    {
        return "RedirectUtil";
    }
}
