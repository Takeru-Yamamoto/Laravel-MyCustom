<?php

namespace MyCustom\Utils\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \MyCustom\Utils\Http\HttpRequestUtil make(\MyCustom\Utils\Http\Enums\MethodEnum $method, string $url, array $params = [])
 * 
 * @method static \MyCustom\Utils\Http\HttpRequestUtil get(string $url, array $params = [])
 * @method static \MyCustom\Utils\Http\HttpRequestUtil post(string $url, array $params = [])
 * @method static \MyCustom\Utils\Http\HttpRequestUtil put(string $url, array $params = [])
 * @method static \MyCustom\Utils\Http\HttpRequestUtil delete(string $url, array $params = [])
 * @method static \MyCustom\Utils\Http\HttpRequestUtil head(string $url, array $params = [])
 * @method static \MyCustom\Utils\Http\HttpRequestUtil patch(string $url, array $params = [])
 * 
 * @method static \MyCustom\Utils\Http\HttpResponseUtil getResponse(string $url, array $params = [])
 * @method static \MyCustom\Utils\Http\HttpResponseUtil postResponse(string $url, array $params = [])
 * @method static \MyCustom\Utils\Http\HttpResponseUtil putResponse(string $url, array $params = [])
 * @method static \MyCustom\Utils\Http\HttpResponseUtil deleteResponse(string $url, array $params = [])
 * @method static \MyCustom\Utils\Http\HttpResponseUtil headResponse(string $url, array $params = [])
 * @method static \MyCustom\Utils\Http\HttpResponseUtil patchResponse(string $url, array $params = [])
 * 
 * @see \MyCustom\Utils\Facades\Managers\HttpUtilManager
 */
class Http extends Facade
{
    /** 
     * Get the registered name of the component. 
     * 
     * @return string 
     */
    protected static function getFacadeAccessor()
    {
        return "HttpUtil";
    }
}
