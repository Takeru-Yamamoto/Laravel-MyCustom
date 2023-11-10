<?php

namespace App\Http\Forms\LoginInfo;

use MyCustom\Http\Forms\BaseForm;

final class AuthenticationCodeForm extends BaseForm
{
    public readonly int $userId;
    public readonly string $email;

    protected function rules(): array
    {
        return [
            "user_id" => $this->required($this->userId()),
            "email"   => $this->required($this->email(), $this->uniqueNotDeleted("users", "email")->ignore($this->inputInt("user_id"))),
        ];
    }

    protected function attributes(): array
    {
        return [
            "user_id" => ___("login_info.word.user_id"),
            "email"   => ___("login_info.word.email"),
        ];
    }

    protected function messages(): array
    {
        return [
            "user_id.required" => ":attributeは必ず指定してください。",
            "user_id.integer"  => ":attributeは整数で指定してください。",
            "user_id.exists"   => "指定された:attributeは存在しません。",

            "email.required" => ":attributeは必ず指定してください。",
            "email.string"   => ":attributeは文字列で指定してください。",
            "email.email"    => ":attributeはメールアドレス形式で指定してください。",
            "email.max"      => ":attributeは:max文字以内で指定してください。",
            "email.unique"   => "指定された:attributeは既に使用されています。",
        ];
    }

    protected function bind(): void
    {
        $this->userId = $this->inputInt("user_id");
        $this->email  = $this->inputString("email");
    }
}
