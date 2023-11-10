<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\LoginInfo as Forms;
use App\Mails\EmailResetMail;

use MyCustom\Utils\Facades\Crypt;

final class LoginInfoService extends BaseService
{
    public function update(Forms\UpdateForm $form): ?string
    {
        $user = $this->UserRepository->findRaw("id", $form->id);

        $user->name  = $form->name;
        $user->email = $form->email;
        if (!is_null($form->password)) {
            $user->password = Crypt::makeHash($form->password);
        }

        return $user->safeUpdate();
    }

    public function createAuthenticationCode(Forms\AuthenticationCodeForm $form): bool
    {
        $authenticationCode = randomNumber(6);

        $emailResetMail = new EmailResetMail(["authenticationCode" => $authenticationCode], $form->email);

        $entity = $this->EmailResetRepository->createEntity(
            $form->userId,
            $authenticationCode,
            $form->email,
            Crypt::expirationDate($emailResetMail->expirationMinute())
        );

        $createResult = $entity->safeCreate();

        if (is_string($createResult)) return false;

        return $emailResetMail->sending();
    }

    public function isExpirationDateOver(Forms\ChangeEmailForm $form): Bool
    {
        $entity = $this->EmailResetRepository->where("user_id", $form->userId)->where("authentication_code", $form->authenticationCode)->findRaw();

        return is_null($entity) ? true : $entity->expirationDateOver();
    }

    public function changeEmail(Forms\ChangeEmailForm $form): bool
    {
        $emailReset = $this->EmailResetRepository->where("user_id", $form->userId)->where("authentication_code", $form->authenticationCode)->findRaw();

        $user = authUser();

        $user->email = $emailReset->new_email;

        $changeEmailResult = $user->safeUpdate();

        return is_null($changeEmailResult);
    }
}
