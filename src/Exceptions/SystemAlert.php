<?php

namespace MyCustom\Exceptions;

use Throwable;

use MyCustom\Sendables\Mail\BaseMail;

/**
 * システムアラート送信クラス
 */
final class SystemAlert extends BaseMail
{
    function __construct(Throwable $throwable, string $toAddress)
    {
        parent::__construct(
            ["throwable" => $throwable],
            $toAddress,
        );
    }

    protected function fromAddress(): string
    {
        return config("mycustom.system_alert.from.address");
    }

    protected function fromName(): string
    {
        return config("mycustom.system_alert.from.name");
    }

    protected function viewName(): string
    {
        return "systemAlert";
    }

    protected function emailSubject(): string
    {
        return "[" . config("mycustom.site_name") . "]" . config("mycustom.system_alert.subject");
    }
}
