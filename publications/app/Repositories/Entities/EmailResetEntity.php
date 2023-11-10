<?php

namespace App\Repositories\Entities;

use MyCustom\Repositories\Entities\BaseEntity;

use App\Models\EmailReset;

use Carbon\Carbon;

final class EmailResetEntity extends BaseEntity
{
    /**
     * Entityに紐づけられたModelのクラス名
     * 
     * @var string $modelClass
     */
    protected string $modelClass = EmailReset::class;

    public readonly ?int $id;
    public readonly ?int $userId;
    public readonly ?string $authenticationCode;
    public readonly ?string $newEmail;
    public readonly ?string $expirationDate;
    public readonly ?Carbon $createdAt;

    protected function bindProperties(): void
    {
        $this->id                 = $this->intValue("id");
        $this->userId             = $this->intValue("user_id");
        $this->authenticationCode = $this->stringValue("authentication_code");
        $this->newEmail           = $this->stringValue("new_email");
        $this->expirationDate     = $this->stringValue("expiration_date");
        $this->createdAt          = $this->timestampValue("created_at");
    }
}
