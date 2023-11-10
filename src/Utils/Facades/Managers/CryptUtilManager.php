<?php

namespace MyCustom\Utils\Facades\Managers;

use MyCustom\Utils\Crypt\CryptUtil;

class CryptUtilManager
{
    public function make(): CryptUtil
    {
        return new CryptUtil();
    }


    public function encryptParams(array $params): string
    {
        return $this->make()->encryptParams($params);
    }

    public function makeHash(string $text): string
    {
        return $this->make()->makeHash($text);
    }

    public function checkHash(string $text, string $hashedText): bool
    {
        return $this->make()->checkHash($text, $hashedText);
    }

    public function expirationDate(int $minute): string
    {
        return $this->make()->expirationDate($minute);
    }
}
