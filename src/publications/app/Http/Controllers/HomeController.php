<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

use App\Http\Controllers\BaseController;
use App\Services\HomeService;

class HomeController extends BaseController
{
    private HomeService $service;

    function __construct()
    {
        $this->service = new HomeService;
    }

    public function index(): View
    {
        if (!isLoggedIn()) return $this->guestIndex();
        if (isSystem()) return $this->systemIndex();
        if (isAdmin()) return $this->adminIndex();
        if (isUser()) return $this->userIndex();
    }

    public function systemIndex(): View
    {
        return $this->pagesView("system");
    }

    public function adminIndex(): View
    {
        return $this->pagesView("admin");
    }

    public function userIndex(): View
    {
        return $this->pagesView("user");
    }

    public function guestIndex(): View
    {
        return $this->pagesView("guest");
    }
}
