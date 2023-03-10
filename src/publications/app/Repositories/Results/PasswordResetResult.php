<?php

namespace App\Repositories\Results;

use MyCustom\Repositories\Results\BaseResult;
use App\Models\PasswordReset;

class PasswordResetResult extends BaseResult
{
    public $id;
    public $email;
    public $token;
    public $expirationDate;
    public $createdAt;

    public function __construct(PasswordReset $entity)
    {
        $this->id             = $entity->id;
        $this->email          = $entity->email;
        $this->token          = $entity->token;
        $this->expirationDate = $entity->expiration_date;
        $this->createdAt      = $entity->created_at;
    }
}
