<?php

namespace App\Repositories\Entities;

use MyCustom\Repositories\Entities\BaseEntity;

use App\Models\User;

use App\Enums\UserRoleEnum;

use Carbon\Carbon;

final class UserEntity extends BaseEntity
{
    /**
     * Entityに紐づけられたModelのクラス名
     * 
     * @var string $modelClass
     */
    protected string $modelClass = User::class;

    public readonly ?int $id;
    public readonly ?string $name;
    public readonly ?string $email;
    public readonly ?UserRoleEnum $role;
    public readonly ?bool $isValid;
    public readonly ?Carbon $createdAt;
    public readonly ?Carbon $updatedAt;

    protected function bindProperties(): void
    {
        $this->id        = $this->intValue("id");
        $this->name      = $this->stringValue("name");
        $this->email     = $this->stringValue("email");
        $this->role      = $this->enumValue("role", UserRoleEnum::class);
        $this->isValid   = $this->boolValue("is_valid");
        $this->createdAt = $this->timestampValue("created_at");
        $this->updatedAt = $this->timestampValue("updated_at");
    }
}
