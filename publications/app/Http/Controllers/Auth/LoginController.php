<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

use App\Http\Forms\Auth\Login as Forms;
use App\Services\Auth\LoginService;

use MyCustom\Utils\Facades\Redirect;
use MyCustom\Utils\Facades\Text;

final class LoginController extends Controller
{
    private LoginService $service;

    function __construct()
    {
        $this->service = new LoginService;
    }

    public function showLoginForm(): View
    {
        return view("auth.login");
    }

    public function login(Request $request): RedirectResponse
    {
        $form = new Forms\LoginForm($request);

        if ($this->service->isTooManyAttempts($form)) return Redirect::route("showLoginForm")->dangerMessage($this->service->tooManyAttempts($form))->response;

        if ($this->service->isFailedLoginAttempt($form)) return Redirect::route("showLoginForm")->dangerMessage($this->service->failedLoginAttempt($form))->response;

        $this->service->login($form);

        return Redirect::route("home")->successMessage(Text::succeededText("auth.login"))->response;
    }

    public function logout(Request $request): RedirectResponse
    {
        $form = new Forms\LogoutForm($request);

        $this->service->logout($form);

		$redirectUtil = config("mycustom.required_login") ? Redirect::route("showLoginForm") : Redirect::route("home");

        return $redirectUtil->successMessage(Text::succeededText("auth.logout"))->response;
    }
}
