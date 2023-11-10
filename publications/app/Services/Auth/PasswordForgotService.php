<?php

namespace App\Services\Auth;

use App\Services\BaseService;

use App\Http\Forms\Auth\PasswordForgot as Forms;
use App\Mails\PasswordForgotMail;

use MyCustom\Utils\Facades\Crypt;

final class PasswordForgotService extends BaseService
{
    public function isExistValidPasswordResetToken(Forms\ReceiveEmailAddressForm $form): Bool
    {
        return $this->PasswordResetTokenRepository->where("email", $form->email)->notExpirationDateOver()->isExist();
    }

    public function sendPasswordResetMail(Forms\ReceiveEmailAddressForm $form): \stdClass
    {
        $sendPasswordResetMailResult = new \stdClass();

        $token = Crypt::makeHash(randomText(40));

        $crypted = Crypt::encryptParams(["token" => $token, "email" => $form->email]);

        $passwordForgotMail = new PasswordForgotMail(["crypted" => $crypted], $form->email);

        $entity = $this->PasswordResetTokenRepository->createEntity(
            $form->email,
            $token,
            Crypt::expirationDate($passwordForgotMail->expirationMinute())
        );

        $createResult = $entity->safeCreate();

        if (is_string($createResult)) {
            $sendPasswordResetMailResult->isSend  = false;
            $sendPasswordResetMailResult->addText = $createResult;

            return $sendPasswordResetMailResult;
        }


        $sendPasswordResetMailResult->isSend  = $passwordForgotMail->sending();
        $sendPasswordResetMailResult->addText = "";

        return $sendPasswordResetMailResult;
    }

    public function isExpirationDateOver(Forms\PasswordResetPreparationForm $form): Bool
    {
        $entity = $this->PasswordResetTokenRepository->where("email", $form->email)->where("token", $form->token)->findRaw();

        return is_null($entity) ? true : $entity->expirationDateOver();
    }

    public function resetPassword(Forms\PasswordResetForm $form): bool
    {
        $user = $this->UserRepository->where("email", $form->email)->findRaw();

        $user->password = Crypt::makeHash($form->password);

        $userUpdateResult = $user->safeUpdate();

        if (!is_null($userUpdateResult)) return false;

        $passwordResetToken = $this->PasswordResetTokenRepository->where("email", $form->email)->where("token", $form->token)->findRaw();

        $resetPasswordResult = $passwordResetToken->safeDelete();

        return is_null($resetPasswordResult);
    }
}
