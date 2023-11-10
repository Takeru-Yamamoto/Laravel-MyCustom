<?php

namespace App\Http\Forms\User;

use MyCustom\Http\Forms\BaseForm;

final class UpdatePreparationForm extends BaseForm
{
    public readonly int $id;

    protected function rules(): array
    {
        return [
            "id" => $this->required($this->userId()),
        ];
    }

    protected function bind(): void
    {
        $this->id = $this->inputInt("id");
    }
}
