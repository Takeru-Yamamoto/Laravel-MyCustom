<?php

namespace App\Repositories\Entities;

use MyCustom\Repositories\Entities\BaseEntity;

use App\Models\PasswordResetToken;

use Carbon\Carbon;

final class PasswordResetTokenEntity extends BaseEntity
{
    /**
     * Entityに紐づけられたModelのクラス名
     * 
     * @var string $modelClass
     */
    protected string $modelClass = PasswordResetToken::class;

    public readonly ?int $id;
    public readonly ?string $email;
    public readonly ?string $token;
    public readonly ?string $expirationDate;
    public readonly ?Carbon $createdAt;

    protected function bindProperties(): void
    {
        $this->id             = $this->intValue("id");
        $this->email          = $this->stringValue("email");
        $this->token          = $this->stringValue("token");
        $this->expirationDate = $this->stringValue("expiration_date");
        $this->createdAt      = $this->timestampValue("created_at");
    }
}
