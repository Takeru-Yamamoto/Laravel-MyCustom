<?php

namespace App\Services;

use App\Services\BaseService;

use App\Http\Forms\User as Forms;
use App\Repositories\Entities;

use MyCustom\Utils\Facades\Crypt;
use MyCustom\Utils\Facades\Paginate;

use Illuminate\Pagination\LengthAwarePaginator;

final class UserService extends BaseService
{
    public function getLowerThanRole(Forms\IndexForm $form): LengthAwarePaginator|null
    {
        $repository = $this->UserRepository->whereGreater("role", authUserRole());

        if (!is_null($form->name)) $repository->whereLike("name", $form->name);
        if (!is_null($form->isValid)) $repository->isValid($form->isValid);

        $result = $repository->paginate($form->page, $form->pageItemLimit);

        return $result->items->isEmpty() ? null : Paginate::fromForm($form, $result->items->toArray(), $result->total);
    }

    public function create(Forms\CreateForm $form): ?string
    {
        $user = $this->UserRepository->createEntity(
            $form->name,
            $form->email,
            Crypt::makeHash($form->password),
            $form->role
        );

        return $user->safeCreate();
    }

    public function findById(Forms\UpdatePreparationForm $form): Entities\UserEntity
    {
        return $this->UserRepository->findById($form->id);
    }

    public function update(Forms\UpdateForm $form): ?string
    {
        $user = $this->UserRepository->findRaw("id", $form->id);

        $user->name  = $form->name;
        $user->email = $form->email;
        $user->role  = $form->role;
        if (!is_null($form->password)) {
            $user->password = Crypt::makeHash($form->password);
        }

        return $user->safeUpdate();
    }

    public function delete(Forms\DeleteForm $form): ?string
    {
        $user = $this->UserRepository->findRaw("id", $form->id);

        return $user->safeDelete();
    }

    public function changeIsValid(Forms\ChangeIsValidForm $form): ?string
    {
        $user = $this->UserRepository->findRaw("id", $form->id);

        return $user->changeIsValid($form->isValid);
    }
}
