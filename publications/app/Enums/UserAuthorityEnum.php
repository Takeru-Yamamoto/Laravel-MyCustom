<?php

namespace App\Enums;

use MyCustom\Enums\EnumTrait;

use App\Models\User;

enum UserAuthorityEnum: string
{
    case SYSTEM       = "system";
    case ADMIN        = "admin";
    case USER         = "user";
    case ADMIN_HIGHER = "admin-higher";
    case USER_HIGHER  = "user-higher";

    use EnumTrait;

    public function isAuthorized(User $user): bool
    {
        return match ($this) {
            self::SYSTEM       => $user->role->isSystem(),
            self::ADMIN        => $user->role->isAdmin(),
            self::USER         => $user->role->isUser(),
            self::ADMIN_HIGHER => $user->role->isAdminHigher(),
            self::USER_HIGHER  => $user->role->isUserHigher(),
        };
    }
}
