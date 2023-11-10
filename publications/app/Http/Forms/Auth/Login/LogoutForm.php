<?php

namespace App\Http\Forms\Auth\Login;

use MyCustom\Http\Forms\BaseForm;

final class LogoutForm extends BaseForm
{
    protected function rules(): array
    {
        return [];
    }

    protected function bind(): void
    {
    }
}
