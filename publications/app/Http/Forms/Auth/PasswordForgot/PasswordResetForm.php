<?php

namespace App\Http\Forms\Auth\PasswordForgot;

use MyCustom\Http\Forms\BaseForm;

final class PasswordResetForm extends BaseForm
{
    public readonly string $email;
    public readonly string $password;
    public readonly string $token;

    protected function rules(): array
    {
        return [
            "email"    => $this->required($this->email(), $this->existsNotDeleted("users", "email")),
            "password" => $this->required($this->passwordConfirmed()),
            "token"    => $this->required($this->string()),
        ];
    }

    protected function attributes(): array
    {
        return [
            "email"    => ___("auth.email"),
            "password" => ___("auth.password"),
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

            "password.required"  => ":attributeは必ず指定してください。",
            "password.string"    => ":attributeは文字列で指定してください。",
            "password.max"       => ":attributeは:max文字以内で指定してください。",
            "password.min"       => ":attributeは:min文字以上で指定してください。",
            "password.confirmed" => ":attributeが確認用の値と一致しません。",
        ];
    }

    protected function bind(): void
    {
        $this->password = $this->inputString("password");
        $this->email    = $this->inputString("email");
        $this->token    = $this->inputString("token");
    }
}
