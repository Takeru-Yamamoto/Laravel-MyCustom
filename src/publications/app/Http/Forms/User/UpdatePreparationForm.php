<?php

namespace App\Http\Forms\User;

use MyCustom\Forms\BaseForm;

class UpdatePreparationForm extends BaseForm
{
    public $id;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            "id" => $this->required($this->userId()),
        ];
    }

    protected function bind(): void
    {
        $this->id = intval($this->input["id"]);
    }
    
    protected function afterBinding(): void
    {
    }
}
