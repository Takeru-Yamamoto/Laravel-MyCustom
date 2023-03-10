<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\LoginInfo as Forms;
use Carbon\Carbon;

class LoginInfoService extends BaseService
{
    public function update(Forms\UpdateForm $form): bool
    {
        $user = $this->UserRepository->findRawById($form->id);

        $user->name  = $form->name;
        $user->email = $form->email;
        if (!is_null($form->password)) {
            $user->password = $this->makeHash($form->password);
        }

        $user->safeUpdate();

        return true;
    }

    public function authenticationCodeForm(Forms\AuthenticationCodeForm $form): bool
    {
        $authenticationCode = randomNumber(6);

        $entity = $this->EmailResetRepository->createEntity(
            $form->userId,
            $authenticationCode,
            $form->email,
            $this->expirationDate(config("mycustoms.presentation-domain.email_expiration_minute"))
        );

        $entity->safeCreate();

        return $this->sendMail("emailReset", ["authenticationCode" => $authenticationCode], $form->email);
    }

    public function changeEmail(Forms\ChangeEmailForm $form): bool
    {
        $authenticateResult = $this->EmailResetRepository->where("user_id", $form->userId)->where("authentication_code", $form->authenticationCode)->findRaw();

        if ((new Carbon($authenticateResult->expiration_date))->isPast()) return false;

        $user = authUser();

        $user->email = $authenticateResult->new_email;

        $user->safeUpdate();

        return true;
    }
}
