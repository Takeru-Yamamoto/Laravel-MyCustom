<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

use App\Http\Controllers\BaseController;
use App\Http\Forms\LoginInfo as Forms;
use App\Services\LoginInfoService;

class LoginInfoController extends BaseController
{
    private LoginInfoService $service;

    function __construct()
    {
        $this->service = new LoginInfoService;
    }

    public function index(): View
    {
        return $this->pagesView("loginInfo.index", ['user' => $this->service->authUserResult()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $this->service->update(new Forms\UpdateForm($request->all()));

        return $this->successRedirect("login_info.index", $this->updatedText("login_info.title"));
    }

    public function changeEmailForm(): View
    {
        return $this->pagesView("loginInfo.changeEmailForm", ['user' => $this->service->authUserResult()]);
    }

    public function authenticationCodeForm(Request $request): View|RedirectResponse
    {
        $isSendEmailReset = $this->service->authenticationCodeForm(new Forms\AuthenticationCodeForm($request->all()));

        return $isSendEmailReset ? $this->pagesView("loginInfo.authenticationCodeForm", ['user' => $this->service->authUserResult()]) : $this->failureRedirect("login_info.changeEmailForm", $this->failedText("email.send"));
    }

    public function changeEmail(Request $request): RedirectResponse
    {
        $form = new Forms\ChangeEmailForm($request->all());

        $changeEmailResult = $this->service->changeEmail($form);

        return $changeEmailResult ? $this->successRedirect("login_info.index", $this->succeededText("email.send")) : $this->failureRedirect("login_info.index", ___("email.code_expired"));
    }
}
