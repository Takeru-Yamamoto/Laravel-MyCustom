<?php

namespace App\Repositories;

use MyCustom\Repositories\BaseRepository;

use App\Models\EmailReset;
use App\Repositories\Entities\EmailResetEntity;

final class EmailResetRepository extends BaseRepository
{
    /**
     * 関連するModelのクラス名
     *
     * @var string
     */
    protected string $modelClass = EmailReset::class;

    /**
     * 関連するEntityのクラス名
     *
     * @var string
     */
    protected string $entityClass = EmailResetEntity::class;


    public function createEntity(
        int $userId,
        string $authenticationCode,
        string $newEmail,
        string $expirationDate
    ): EmailReset {
        $entity = $this->model();

        $entity->user_id             = $userId;
        $entity->authentication_code = $authenticationCode;
        $entity->new_email           = $newEmail;
        $entity->expiration_date     = $expirationDate;

        return $entity;
    }

    /* original methods */
}
