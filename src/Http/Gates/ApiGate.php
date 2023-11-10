<?php

namespace MyCustom\Http\Gates;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

final class ApiGate
{
    /**
     * Apiルートで使用するGate定義ファイル
     * 
     * リクエストヘッダーの中のアクセストークンヘッダーとアクセストークンが一致するかを確認する
     * 
     */
    public static function define()
    {
        Gate::define("api-access", function ($user = null) {
            return Hash::check(config("mycustom.api_access_token"), request()->header(config("mycustom.api_access_token_header")));
        });
    }
}
