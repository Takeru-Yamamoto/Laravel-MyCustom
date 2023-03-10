<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

use App\Http\Controllers\BaseController;
use App\Services\Auth\LoginService;

class LoginController extends BaseController
{
    private LoginService $service;

    function __construct()
    {
        $this->service = new LoginService;
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        return $this->service->login($request);
    }

    public function logout(Request $request): RedirectResponse
    {
        return $this->service->logout($request);
    }
}
