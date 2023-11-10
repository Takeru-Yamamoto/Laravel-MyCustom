<?php

namespace App\Repositories;

use MyCustom\Repositories\BaseRepository;

use App\Models\User;
use App\Repositories\Entities\UserEntity;

use App\Enums\UserRoleEnum;

final class UserRepository extends BaseRepository
{
    /**
     * 関連するModelのクラス名
     *
     * @var string
     */
    protected string $modelClass = User::class;

    /**
     * 関連するEntityのクラス名
     *
     * @var string
     */
    protected string $entityClass = UserEntity::class;


    public function createEntity(
        string $name,
        string $email,
        string $password,
        UserRoleEnum $role
    ): User {
        $entity = $this->model();

        $entity->name     = $name;
        $entity->email    = $email;
        $entity->password = $password;
        $entity->role     = $role;

        return $entity;
    }

    /* original methods */

    public function findById(int $id): UserEntity
    {
        return $this->where("id", $id)->find();
    }
}
