<?php

namespace MyCustom\Utils\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \MyCustom\Utils\Calculate\CalculateUtil make()
 * 
 * @method static int|float power(int|float $num, int $exponent)
 * @method static int|float squared(int|float $num)
 * @method static int|float cubed(int|float $num)
 * 
 * @method static bool isPrime(int $num)
 * @method static int primeCount(int $num, int $primeNum)
 * @method static array primeFactorization(int $num)
 * @method static int fibonacci(int $num)
 * @method static int|string factorial(int $num, bool $returnString = false)
 * 
 * @see \MyCustom\Utils\Facades\Managers\CalculateUtilManager
 */
class Calculate extends Facade
{
    /** 
     * Get the registered name of the component. 
     * 
     * @return string 
     */
    protected static function getFacadeAccessor()
    {
        return "CalculateUtil";
    }
}
