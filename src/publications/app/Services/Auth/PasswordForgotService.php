<?php

namespace App\Services\Auth;

use App\Services\BaseService;

use App\Http\Forms\Auth\PasswordForgot as Forms;

class PasswordForgotService extends BaseService
{
    public function sendPasswordResetMail(Forms\ReceiveEmailAddressForm $form): bool
    {
        $token = $this->makeHash(randomText(40));

        $entity = $this->PasswordResetRepository->createEntity(
            $form->email,
            $token,
            $this->expirationDate(config("mycustoms.presentation-domain.email_expiration_minute"))
        );

        $entity->safeCreate();

        $data["url"] = route("passwordResetForm", ["token" => $token, "email" => $form->email]);

        return $this->sendMail("passwordForgot", $data, $form->email);
    }

    public function resetPassword(Forms\PasswordResetForm $form): bool
    {
        $user = $this->UserRepository->where("email", $form->email)->findRaw();

        $user->password = $this->makeHash($form->password);

        $user->safeUpdate();

        return true;
    }
}
