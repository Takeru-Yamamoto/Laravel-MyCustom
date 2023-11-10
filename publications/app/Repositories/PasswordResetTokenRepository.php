<?php

namespace App\Repositories;

use MyCustom\Repositories\BaseRepository;

use App\Models\PasswordResetToken;
use App\Repositories\Entities\PasswordResetTokenEntity;

final class PasswordResetTokenRepository extends BaseRepository
{
    /**
     * 関連するModelのクラス名
     *
     * @var string
     */
    protected string $modelClass = PasswordResetToken::class;

    /**
     * 関連するEntityのクラス名
     *
     * @var string
     */
    protected string $entityClass = PasswordResetTokenEntity::class;


    public function createEntity(
        string $email,
        string $token,
        string $expiration_date
    ): PasswordResetToken {
        $entity = $this->model();

        $entity->email           = $email;
        $entity->token           = $token;
        $entity->expiration_date = $expiration_date;

        return $entity;
    }

    /* original methods */
}
