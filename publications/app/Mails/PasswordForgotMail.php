<?php

namespace App\Mails;

use MyCustom\Sendables\Mail\ExpirationMail;

final class PasswordForgotMail extends ExpirationMail
{
    protected function viewName(): string
    {
        return "passwordForgot";
    }

    protected function emailSubject(): string
    {
        return ___("email.password_forgot");
    }
}
