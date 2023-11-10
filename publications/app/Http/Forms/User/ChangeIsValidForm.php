<?php

namespace App\Http\Forms\User;

use MyCustom\Http\Forms\BaseForm;

final class ChangeIsValidForm extends BaseForm
{
    public readonly int $id;
    public readonly int $isValid;

    protected function rules(): array
    {
        return [
            "id"  => $this->required($this->userId()),
            "flg" => $this->required($this->tinyInteger()),
        ];
    }

    protected function bind(): void
    {
        $this->id      = $this->inputInt("id");
        $this->isValid = $this->inputInt("flg");
    }
}
