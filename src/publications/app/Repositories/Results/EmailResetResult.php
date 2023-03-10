<?php

namespace App\Repositories\Results;

use MyCustom\Repositories\Results\BaseResult;
use App\Models\EmailReset;

class EmailResetResult extends BaseResult
{
    public $id;
    public $userId;
    public $authenticationCode;
    public $newEmail;
    public $expirationDate;
    public $createdAt;

    public function __construct(EmailReset $entity)
    {
        $this->id                 = $entity->id;
        $this->userId             = $entity->user_id;
        $this->authenticationCode = $entity->authentication_code;
        $this->newEmail           = $entity->new_email;
        $this->expirationDate     = $entity->expiration_date;
        $this->createdAt          = $entity->created_at;
    }
}
