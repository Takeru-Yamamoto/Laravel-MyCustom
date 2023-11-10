<?php

namespace App\Http\Forms\User;

use MyCustom\Http\Forms\PaginationForm;

final class IndexForm extends PaginationForm
{
    public readonly ?string $name;
    public readonly ?int $isValid;

    protected function rules(): array
    {
        return [
            "name"     => $this->nullable($this->string()),
            "is_valid" => $this->nullable($this->tinyInteger()),
        ];
    }

    protected function bind(): void
    {
        $this->name    = $this->inputNullableString("name");
        $this->isValid = $this->inputNullableInt("is_valid");
    }
}
