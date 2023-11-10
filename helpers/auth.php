<?php

use App\Models\User;

use App\Enums\UserRoleEnum;
use App\Enums\UserAuthorityEnum;

if (!function_exists("isLoggedIn")) {

    /**
     * ログインしているかどうか
     */
    function isLoggedIn(): bool
    {
        return auth()->check();
    }
}


if (!function_exists("userCan")) {

    /**
     * user に attribute の権限が付与されているか
     *
     * @param UserAuthorityEnum|string $attribute
     * @param User|null $user
     */
    function userCan(UserAuthorityEnum|string $attribute, User $user = null): bool
    {
        if (is_null($user)) $user = authUser();

        if ($attribute instanceof UserAuthorityEnum) $attribute = $attribute->value;

        return $user->can($attribute);
    }
}


if (!function_exists("isSystem")) {

    /**
     * user に system権限が付与されているか
     *
     * @param User|null $user
     */
    function isSystem(User $user = null): bool
    {
        return userCan(UserAuthorityEnum::SYSTEM, $user);
    }
}


if (!function_exists("isAdmin")) {

    /**
     * user に admin権限が付与されているか
     *
     * @param User|null $user
     */
    function isAdmin(User $user = null): bool
    {
        return userCan(UserAuthorityEnum::ADMIN, $user);
    }
}


if (!function_exists("isUser")) {

    /**
     * user に user権限が付与されているか
     *
     * @param User|null $user
     */
    function isUser(User $user = null): bool
    {
        return userCan(UserAuthorityEnum::USER, $user);
    }
}


if (!function_exists("isAdminHigher")) {

    /**
     * user に admin-higher権限が付与されているか
     *
     * @param User|null $user
     */
    function isAdminHigher(User $user = null): bool
    {
        return userCan(UserAuthorityEnum::ADMIN_HIGHER, $user);
    }
}


if (!function_exists("isUserHigher")) {

    /**
     * user に user-higher権限が付与されているか
     *
     * @param User|null $user
     */
    function isUserHigher(User $user = null): bool
    {
        return userCan(UserAuthorityEnum::USER_HIGHER, $user);
    }
}


if (!function_exists("authUser")) {

    /**
     * ログイン中のユーザを取得
     */
    function authUser(): User
    {
        return auth()->user();
    }
}


if (!function_exists("authUserProperty")) {

    /**
     * ログイン中のユーザのプロパティを取得
     */
    function authUserProperty(string $key): mixed
    {
        return isset(authUser()->$key) ? authUser()->$key : null;
    }
}


if (!function_exists("authUserId")) {

    /**
     * ログイン中のユーザの id を取得
     */
    function authUserId(): ?int
    {
        return authUserProperty("id");
    }
}


if (!function_exists("authUserName")) {

    /**
     * ログイン中のユーザの name を取得
     */
    function authUserName(): ?string
    {
        return authUserProperty("name");
    }
}


if (!function_exists("authUserRole")) {

    /**
     * ログイン中のユーザの role を取得
     */
    function authUserRole(): ?UserRoleEnum
    {
        return authUserProperty("role");
    }
}
