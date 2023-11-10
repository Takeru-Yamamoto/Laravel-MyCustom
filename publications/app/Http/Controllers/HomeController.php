<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

use App\Services\HomeService;

use MyCustom\Utils\Facades\Redirect;

final class HomeController extends Controller
{
    private HomeService $service;

    function __construct()
    {
        $this->service = new HomeService;
    }

    public function index(): View|RedirectResponse
    {
        if (!isLoggedIn()) return config("mycustom.required_login") ? Redirect::route("showLoginForm")->response : $this->guestIndex();
        if (isSystem()) return $this->systemIndex();
        if (isAdmin()) return $this->adminIndex();
        if (isUser()) return $this->userIndex();
    }

    public function systemIndex(): View
    {
        return view("system");
    }

    public function adminIndex(): View
    {
        return view("admin");
    }

    public function userIndex(): View
    {
        return view("user");
    }

    public function guestIndex(): View
    {
        return view("guest");
    }
}
