<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

use App\Http\Controllers\BaseController;
use App\Http\Forms\Auth\PasswordForgot as Forms;
use App\Services\Auth\PasswordForgotService;

class PasswordForgotController extends BaseController
{
    private PasswordForgotService $service;

    function __construct()
    {
        $this->service = new PasswordForgotService;
    }

    public function showEmailInputForm(): View
    {
        return view('auth.passwordForgot');
    }

    public function receiveEmailAddress(Request $request): RedirectResponse
    {
        $sendPasswordResetMailResult = $this->service->sendPasswordResetMail(new Forms\ReceiveEmailAddressForm($request->all()));

        return $sendPasswordResetMailResult ? $this->successRedirect("showEmailInputForm", $this->succeededText("email.send")) : $this->failureRedirect("showEmailInputForm", $this->failedText("email.send"));
    }

    public function passwordResetForm(string $token, string $email): View|RedirectResponse
    {
        $form = new Forms\PasswordResetPreparationForm(compact("token", "email"));

        return view('auth.passwordReset', ["email" => $form->email, "token" => $form->token]);
    }

    public function passwordReset(Request $request): RedirectResponse
    {
        $this->service->resetPassword(new Forms\PasswordResetForm($request->all()));

        return $this->successRedirect("login", $this->updatedText("word.password"));
    }
}
