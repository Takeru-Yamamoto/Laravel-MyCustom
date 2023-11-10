<?php

namespace App\Http\Forms\Auth\PasswordForgot;

use MyCustom\Http\Forms\BaseForm;

final class ReceiveEmailAddressForm extends BaseForm
{
    public readonly string $email;

    protected function rules(): array
    {
        return [
            "email" => $this->required($this->email(), $this->existsNotDeleted("users", "email")),
        ];
    }

    protected function attributes(): array
    {
        return [
            "email" => ___("auth.email"),
        ];
    }

    protected function messages(): array
    {
        return [
            "email.required" => ":attributeは必ず指定してください。",
            "email.string"   => ":attributeは文字列で指定してください。",
            "email.email"    => ":attributeはメールアドレス形式で指定してください。",
            "email.max"      => ":attributeは:max文字以内で指定してください。",
            "email.exists"   => "指定された:attributeは存在しません。",
        ];
    }

    protected function bind(): void
    {
        $this->email = $this->inputString("email");
    }
}
