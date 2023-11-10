<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

use App\Http\Forms\LoginInfo as Forms;
use App\Services\LoginInfoService;

use MyCustom\Utils\Facades\Redirect;
use MyCustom\Utils\Facades\Text;

final class LoginInfoController extends Controller
{
    private LoginInfoService $service;

    function __construct()
    {
        $this->service = new LoginInfoService;
    }

    public function index(): View
    {
        return view("loginInfo.index", ["user" => $this->service->authUserEntity()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $updateResult = $this->service->update(new Forms\UpdateForm($request));

        $redirectUtil = Redirect::route("login_info.index");

        return is_string($updateResult)
            ? $redirectUtil->dangerMessage(Text::failedText("login_info.update"), $updateResult)->response
            : $redirectUtil->successMessage(Text::succeededText("login_info.update"))->response;
    }

    public function changeEmailForm(): View
    {
        return view("loginInfo.changeEmailForm", ["user" => $this->service->authUserEntity()]);
    }

    public function createAuthenticationCode(Request $request): RedirectResponse
    {
        $isSendEmailReset = $this->service->createAuthenticationCode(new Forms\AuthenticationCodeForm($request));

        return $isSendEmailReset
            ? Redirect::route("login_info.authenticationCodeForm")->successMessage(Text::createSucceededText("login_info.word.authentication_code"))->response
            : Redirect::route("login_info.changeEmailForm")->dangerMessage(Text::createFailedText("login_info.word.authentication_code"))->response;
    }

    public function authenticationCodeForm(): View
    {
        return view("loginInfo.authenticationCodeForm", ["user" => $this->service->authUserEntity()]);
    }

    public function changeEmail(Request $request): RedirectResponse
    {
        $form = new Forms\ChangeEmailForm($request);

        if ($this->service->isExpirationDateOver($form)) return Redirect::route("login_info.index")->dangerMessage(___("email.code_expired"))->response;

        $changeEmailEntity = $this->service->changeEmail($form);

        $redirectUtil = Redirect::route("login_info.index");

        return $changeEmailEntity
            ? $redirectUtil->successMessage(Text::updateSucceededText("login_info.word.email"))->response
            : $redirectUtil->dangerMessage(Text::text("email.code_expired"))->response;
    }
}
