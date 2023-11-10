<?php

namespace MyCustom\Utils\Crypt;

use MyCustom\Jsonables\BaseJsonable;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

final class CryptUtil extends BaseJsonable
{
    /**
     * params をAPP_KEYを用いて暗号化する
     *
     * @param array $params
     */
    public function encryptParams(array $params): string
    {
        return encrypt($params);
    }

    /**
     * APP_KEYを用いて暗号化された encrypted を復号する
     *
     * @param string $params
     */
    public function decryptParams(string $params): mixed
    {
        return decrypt($params);
    }

    /**
     * text をハッシュ化する
     *
     * @param string $text
     */
    public function makeHash(string $text): string
    {
        return Hash::make($text);
    }

    /**
     * ハッシュ化された hashedText と text が一致するか
     *
     * @param string $text
     * @param string $hashedText
     */
    public function checkHash(string $text, string $hashedText): bool
    {
        return Hash::check($text, $hashedText);
    }

    /**
     * 現在時刻から minute 分後の時刻を取得する
     *
     * @param integer $minute
     */
    public function expirationDate(int $minute): string
    {
        return (new Carbon())->addMinutes($minute)->toDateTimeString();
    }
}
