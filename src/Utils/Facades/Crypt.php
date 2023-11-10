<?php

namespace MyCustom\Utils\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \MyCustom\Utils\Crypt\CryptUtil make()
 * 
 * @method static string encryptParams(array $params)
 * @method static mixed decryptParams(string $params)
 * @method static string makeHash(string $text)
 * @method static bool checkHash(string $text, string $hashedText)
 * @method static string expirationDate(int $minute)
 * 
 * @see \MyCustom\Utils\Facades\Managers\CryptUtilManager
 */
class Crypt extends Facade
{
    /** 
     * Get the registered name of the component. 
     * 
     * @return string 
     */
    protected static function getFacadeAccessor()
    {
        return "CryptUtil";
    }
}
