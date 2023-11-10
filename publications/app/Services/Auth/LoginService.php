<?php

namespace App\Services\Auth;

use App\Services\BaseService;

use App\Http\Forms\Auth\Login as Forms;

use Illuminate\Auth\Events\Lockout;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;

final class LoginService extends BaseService
{
    /**
     * ログインの連続失敗許容回数
     *
     * @var int
     */
    public const MAX_ATTEMPTS = 5;

    /**
     * ログインの連続失敗許容回数を超えた時のロックアウトされる分数
     *
     * @var int
     */
    public const DECAY_MINUTES = 1;

    /**
     * ログイン成功時に他のデバイスでのログインを無効化するかどうか
     *
     * @var bool
     */
    public const IS_LOGOUT_OTHER_DEVICE = false;


    /**
     * ログイン処理
     *
     * @param Forms\LoginForm $form
     * @return void
     */
    public function login(Forms\LoginForm $form): void
    {
        if ($form->request()->hasSession()) {
            $form->request()->session()->put("auth.password_confirmed_at", time());
        }

        $form->request()->session()->regenerate();

        RateLimiter::clear($form->throttleKey);

        if (self::IS_LOGOUT_OTHER_DEVICE) Auth::logoutOtherDevices($form->password);
    }

    /**
     * ログインの連続失敗許容回数を超えているかどうか
     *
     * @param Forms\LoginForm $form
     * @return bool
     */
    public function isTooManyAttempts(Forms\LoginForm $form): bool
    {
        return RateLimiter::tooManyAttempts($form->throttleKey, self::MAX_ATTEMPTS);
    }

    /**
     * ログインの連続失敗許容回数を超えている場合の処理
     *
     * @param Forms\LoginForm $form
     * @return string
     */
    public function tooManyAttempts(Forms\LoginForm $form): string
    {
        event(new Lockout($form->request()));

        $seconds = RateLimiter::availableIn($form->throttleKey);

        return __("auth.throttle", [
            "seconds" => $seconds,
            "minutes" => ceil($seconds / 60),
        ]);
    }

    /**
     * ログインに失敗したかどうか
     *
     * @param Forms\LoginForm $form
     * @return bool
     */
    public function isFailedLoginAttempt(Forms\LoginForm $form): bool
    {
        return !Auth::guard()->attempt([
            "email"    => $form->email,
            "password" => $form->password,
            "is_valid" => 1,
        ], $form->remember);
    }

    /**
     * ログインに失敗した場合の処理
     *
     * @param Forms\LoginForm $form
     * @return string
     */
    public function failedLoginAttempt(Forms\LoginForm $form): string
    {
        RateLimiter::hit($form->throttleKey, self::DECAY_MINUTES * 60);

        return __("auth.failed");
    }


    /**
     * ログアウト処理
     *
     * @param Forms\LogoutForm $form
     * @return void
     */
    public function logout(Forms\LogoutForm $form): void
    {
        Auth::guard()->logout();

        $form->request()->session()->invalidate();
        $form->request()->session()->regenerateToken();
    }
}
