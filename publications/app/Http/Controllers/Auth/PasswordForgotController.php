<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

use App\Http\Forms\Auth\PasswordForgot as Forms;
use App\Services\Auth\PasswordForgotService;

use MyCustom\Utils\Facades\Redirect;
use MyCustom\Utils\Facades\Text;

final class PasswordForgotController extends Controller
{
    private PasswordForgotService $service;

    function __construct()
    {
        $this->service = new PasswordForgotService;
    }

    public function showEmailInputForm(): View
    {
        return view("auth.passwordForgot");
    }

    public function receiveEmailAddress(Request $request): RedirectResponse
    {
        $form = new Forms\ReceiveEmailAddressForm($request);

        if ($this->service->isExistValidPasswordResetToken($form)) return Redirect::route("showEmailInputForm")->dangerMessage(Text::text(___("email.already_sent")))->response;

        $sendPasswordResetMailResult = $this->service->sendPasswordResetMail($form);

        $redirectUtil = Redirect::route("showEmailInputForm");

        return $sendPasswordResetMailResult->isSend
            ? $redirectUtil->successMessage(Text::succeededText("email.send"))->response
            : $redirectUtil->dangerMessage(Text::failedText("email.send"), $sendPasswordResetMailResult->addText)->response;
    }

    public function passwordResetForm(string $crypted): View|RedirectResponse
    {
        $form = new Forms\PasswordResetPreparationForm(compact("crypted"));

        if ($this->service->isExpirationDateOver($form)) return Redirect::route("login")->dangerMessage(Text::text(___("email.code_expired")))->response;

        return view("auth.passwordReset", ["email" => $form->email, "token" => $form->token]);
    }

    public function passwordReset(Request $request): RedirectResponse
    {
        $resetPasswordResult = $this->service->resetPassword(new Forms\PasswordResetForm($request));

        $redirectUtil = Redirect::route("login");

        return $resetPasswordResult
            ? $redirectUtil->successMessage(Text::updateSucceededText("mycustom.word.password"))->response
            : $redirectUtil->dangerMessage(Text::updateFailedText("mycustom.word.password"))->response;
    }
}
