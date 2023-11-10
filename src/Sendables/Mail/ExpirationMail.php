<?php

namespace MyCustom\Sendables\Mail;

use MyCustom\Sendables\Mail\BaseMail;

/**
 * 制限時間を持つメール送信クラス
 */
abstract class ExpirationMail extends BaseMail
{
    function __construct(array $data, string $toAddress)
    {
        parent::__construct($data, $toAddress);

        $this->data = array_merge($this->data, [
            "expirationMinute" => $this->expirationMinute(),
        ]);
    }

    public function expirationMinute(): int
    {
        return 30;
    }
}
