<?php

namespace MyCustom\Utils\Calculate;

use MyCustom\Jsonables\BaseJsonable;

final class CalculateUtil extends BaseJsonable
{
    /**
     * number の累乗を取得する
     *
     * @param int|float $number
     * @param int $exponent
     * 
     * @return int|float
     */
    public function power(int|float $number, int $exponent): int|float
    {
        return pow($number, $exponent);
    }

    /**
     * number が素数かどうか
     * 
     * @param int $number
     *
     * @return bool
     */
    public function isPrime(int $number): bool
    {
        /* 1以下 */
        if ($number <= 1) return false;

        /* 2以外の偶数 */
        if ($number !== 2 && $number % 2 === 0) return false;

        /* 平方根が整数 */
        if (is_int(sqrt($number))) return false;

        // 平方根の整数部分までの数で割り切れるかどうかを確認する
        $max = floor(sqrt($number));

        // numberは奇数なので3から始めて2ずつ増やしていく
        for ($i = 3; $i <= $max; $i += 2) {

            // 割り切れたら素数ではない
            if ($number % $i == 0) return false;
        }

        return true;
    }

    /**
     * number 番目のフィボナッチ数列の一般項を取得する(計算結果を丸めて取得する)
     * 
     * @param int $number
     *
     * @return int
     */
    public function fibonacci(int $number): int
    {
        // Fn = x * (a - b)の形にする

        // x = 1 / sqrt(5)
        // a = ((1 + sqrt(5)) / 2) ** number
        // b = ((1 - sqrt(5)) / 2) ** number

        $x = 1 / sqrt(5);
        $a = ((1 + sqrt(5)) / 2) ** $number;
        $b = ((1 - sqrt(5)) / 2) ** $number;

        $result = $x * ($a - $b);

        // 計算結果を丸める
        return round($result);
    }

    /**
     * number の階乗を取得する
     * 
     * @param int $number
     * @param bool $returnString
     *
     * @return int
     */
    public function factorial(int $number, bool $returnString): int
    {
        if ($number < 0) throw new \RuntimeException("The factorial of a negative number is not defined.");

        if ($number === 0) return $returnString ? "1" : 1;

        // int型の最大値を超える可能性があるため、string型で計算する
        $result = "1";

        for ($i = 1; $i <= $number; $i++) {
            $result = bcmul($result, $i);
        }

        return $returnString ? $result : (int)$result;
    }

    /**
     * num の素因数分解の結果を取得する
     * 
     * @param int $number
     *
     * @return array
     */
    public function primeFactorization(int $number): array
    {
        $result = [];

        // 1以下の数は素因数分解できない
        if ($number <= 1) return $result;

        // 素数は素因数分解できない
        if ($this->isPrime($number)) return [$number];

        // 平方根の整数部分までの数で割り切れるかどうかを確認する
        $max = floor(sqrt($number));
        $count = 0;

        // 偶数の場合は2で割り切れるだけ割る
        if ($number % 2 === 0) {
            $count = $this->primeCount($number, 2);

            $result[2] = $count;
            $number /= ($count * 2);

            // 割り切れなくなったら終了
            if ($number === 1) return $result;
        }

        // numberは奇数なので3から始めて2ずつ増やしていく
        for ($i = 3; $i <= $max; $i += 2) {

            // 割り切れるだけ割る
            $count = $this->primeCount($number, $i);

            if ($count > 0) {
                $result[$i] = $count;
                $number /= ($count * $i);
            }

            // 割り切れなくなったら終了
            if ($number === 1) return $result;
        }

        // numberはmaxより大きい素数
        $result[$number] = 1;

        return $result;
    }

    /**
     * number の素因数として primeNumber が何回登場するか
     *
     * @param int $number
     * @param int $primeNumber
     * @return int
     */
    public function primeCount(int $number, int $primeNumber): int
    {
        // primeNumberが素数でない場合は0を返す
        if (!$this->isPrime($primeNumber)) return 0;

        // 1以下の数は素因数分解できない
        if ($number <= 1) return 0;

        // 素数は素因数分解できない
        if ($this->isPrime($number)) return $number === $primeNumber ? 1 : 0;

        $count = 0;

        // 割り切れるだけ割る
        while ($number % $primeNumber === 0) {
            $count++;
            $number /= $primeNumber;
        }

        return $count;
    }
}
