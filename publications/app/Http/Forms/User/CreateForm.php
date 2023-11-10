<?php

namespace App\Http\Forms\User;

use MyCustom\Http\Forms\BaseForm;

use App\Enums\UserRoleEnum;

final class CreateForm extends BaseForm
{
    public readonly string $name;
    public readonly string $email;
    public readonly string $password;
    public readonly UserRoleEnum $role;

    protected function rules(): array
    {
        return [
            "name"     => $this->required($this->string(), $this->uniqueNotDeleted("users", "name")),
            "email"    => $this->required($this->email(), $this->uniqueNotDeleted("users", "email")),
            "password" => $this->required($this->passwordConfirmed()),
            "role"     => $this->required($this->in(UserRoleEnum::values())),
        ];
    }

    protected function attributes(): array
    {
        return [
            "name"     => ___("user.word.name"),
            "email"    => ___("user.word.email"),
            "password" => ___("user.word.password"),
            "role"     => ___("user.word.role"),
        ];
    }

    protected function messages(): array
    {
        return [
            "name.required" => ":attributeは必ず指定してください。",
            "name.string"   => ":attributeは文字列で指定してください。",
            "name.max"      => ":attributeは:max文字以内で指定してください。",
            "name.unique"   => "指定された:attributeは既に使用されています。",

            "email.required" => ":attributeは必ず指定してください。",
            "email.string"   => ":attributeは文字列で指定してください。",
            "email.email"    => ":attributeはメールアドレス形式で指定してください。",
            "email.max"      => ":attributeは:max文字以内で指定してください。",
            "email.unique"   => "指定された:attributeは既に使用されています。",

            "password.required"  => ":attributeは必ず指定してください。",
            "password.string"    => ":attributeは文字列で指定してください。",
            "password.max"       => ":attributeは:max文字以内で指定してください。",
            "password.min"       => ":attributeは:min文字以上で指定してください。",
            "password.confirmed" => ":attributeが確認用の値と一致しません。",

            "role.required" => ":attributeは必ず指定してください。",
            "role.in"       => "指定された:attributeは正しくありません。",
        ];
    }

    protected function bind(): void
    {
        $this->name     = $this->inputString("name");
        $this->email    = $this->inputString("email");
        $this->password = $this->inputString("password");
        $this->role     = $this->inputEnumFrom("role", UserRoleEnum::class);
    }
}
