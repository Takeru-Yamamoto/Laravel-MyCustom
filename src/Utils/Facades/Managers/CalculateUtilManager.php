<?php

namespace MyCustom\Utils\Facades\Managers;

use MyCustom\Utils\Calculate\CalculateUtil;

class CalculateUtilManager
{
    public function make(): CalculateUtil
    {
        return new CalculateUtil();
    }


    public function power(int|float $number, int $exponent): int|float
    {
        return $this->make()->power($number, $exponent);
    }

    public function squared(int|float $number): int|float
    {
        return $this->power($number, 2);
    }

    public function cubed(int|float $number): int|float
    {
        return $this->power($number, 3);
    }


    public function isPrime(int $number): bool
    {
        return $this->make()->isPrime($number);
    }

    public function primeCount(int $number, int $primeNumber): int
    {
        return $this->make()->primeCount($number, $primeNumber);
    }

    public function primeFactorization(int $number): array
    {
        return $this->make()->primeFactorization($number);
    }

    public function fibonacci(int $number): int
    {
        return $this->make()->fibonacci($number);
    }

    public function factorial(int $number, bool $returnString = false): int|string
    {
        return $this->make()->factorial($number, $returnString);
    }
}
