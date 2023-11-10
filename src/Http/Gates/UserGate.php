<?php

namespace MyCustom\Http\Gates;

use Illuminate\Support\Facades\Gate;

use App\Enums\UserAuthorityEnum;

final class UserGate
{
    /**
     * Webルートで使用するGate定義ファイル
     * 
     * User Modelのroleカラムを用いて権限を管理する
     */
    public static function define()
    {
        if (enum_exists(UserAuthorityEnum::class)) {
            foreach (UserAuthorityEnum::cases() as $gate) {
                Gate::define($gate->value, function ($user) use ($gate) {
                    return $gate->isAuthorized($user);
                });
            }
        }
    }
}
