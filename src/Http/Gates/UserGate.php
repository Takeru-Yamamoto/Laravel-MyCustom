<?php 

namespace MyCustom\Http\Gates;

use Illuminate\Support\Facades\Gate;

class UserGate 
{
    /**
     * Webルートで使用するGate定義ファイル
     * 
     * User Modelのroleカラムを用いて権限を管理する
     * 
     * system: 1
     * admin : 5
     * user  : 10
     *
     */
    public static function define()
    {
        Gate::define("system", function ($user) {
            return ($user->role === 1);
        });

        Gate::define("admin", function ($user) {
            return ($user->role > 1 && $user->role <= 5);
        });

        Gate::define("user", function ($user) {
            return ($user->role > 5 && $user->role <= 10);
        });

        Gate::define("admin-higher", function ($user) {
            return ($user->role <= 5);
        });

        Gate::define("user-higher", function ($user) {
            return ($user->role <= 10);
        });
    }
}