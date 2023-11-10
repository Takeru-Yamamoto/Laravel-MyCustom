<?php

namespace App\Mails;

use MyCustom\Sendables\Mail\ExpirationMail;

final class EmailResetMail extends ExpirationMail
{
    protected function viewName(): string
    {
        return "emailReset";
    }

    protected function emailSubject(): string
    {
        return ___("email.email_reset");
    }
}
