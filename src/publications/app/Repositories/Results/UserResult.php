<?php

namespace App\Repositories\Results;

use MyCustom\Repositories\Results\BaseResult;
use App\Models\User;

class UserResult extends BaseResult
{
    public $id;
    public $name;
    public $email;
    public $role;
    public $isValid;
    public $createdAt;
    public $updatedAt;

    public function __construct(User $entity)
    {
        $this->id        = $entity->id;
        $this->name      = $entity->name;
        $this->email     = $entity->email;
        $this->role      = $entity->role;
        $this->isValid   = $entity->is_valid;
        $this->createdAt = $entity->created_at;
        $this->updatedAt = $entity->updated_at;
    }
}
