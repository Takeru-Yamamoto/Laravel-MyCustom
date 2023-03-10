<?php

namespace App\Services\Auth;

use App\Services\BaseService;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginService extends BaseService
{
    /**
     * Laravel UI の AuthenticatesUsers使用
     */
    use AuthenticatesUsers;


    /**
     * ログイン成功時のリダイレクト先
     * 
     * Illuminate\Foundation\Auth\AuthenticatesUsers::login()
     * Illuminate\Foundation\Auth\AuthenticatesUsers::sendLoginResponse()
     * Illuminate\Foundation\Auth\RedirectsUsers::redirectPath()
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    /**
     * ログインの連続失敗許容回数
     *
     * Illuminate\Foundation\Auth\AuthenticatesUsers::login()
     * Illuminate\Foundation\Auth\ThrottlesLogins::hasTooManyLoginAttempts()
     * Illuminate\Foundation\Auth\ThrottlesLogins::maxAttempts()
     * 
     * @var integer
     */
    protected int $maxAttempts = 5;

    /**
     * ログインの連続失敗許容回数を超えた時のロックアウトされる分数
     *
     * Illuminate\Foundation\Auth\AuthenticatesUsers::login()
     * Illuminate\Foundation\Auth\ThrottlesLogins::incrementLoginAttempts()
     * Illuminate\Foundation\Auth\ThrottlesLogins::decayMinutes()
     * 
     * @var integer
     */
    protected int $decayMinutes = 1;
}
