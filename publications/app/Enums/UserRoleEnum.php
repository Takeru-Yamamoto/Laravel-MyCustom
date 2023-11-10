<?php

namespace App\Enums;

use MyCustom\Enums\EnumTrait;

enum UserRoleEnum: int
{
    case SYSTEM = 1;
    case ADMIN  = 5;
    case USER   = 10;

    use EnumTrait;

    public function isSystem(): bool
    {
        return ($this->value === self::SYSTEM->value);
    }

    public function isAdmin(): bool
    {
        return ($this->value > self::SYSTEM->value && $this->value <= self::ADMIN->value);
    }

    public function isUser(): bool
    {
        return ($this->value > self::ADMIN->value && $this->value <= self::USER->value);
    }

    public function isAdminHigher(): bool
    {
        return ($this->value <= self::ADMIN->value);
    }

    public function isUserHigher(): bool
    {
        return ($this->value <= self::USER->value);
    }
}
