<?php

namespace App\Http\Forms\LoginInfo;

use MyCustom\Http\Forms\BaseForm;

final class UpdateForm extends BaseForm
{
    public readonly int $id;
    public readonly string $name;
    public readonly string $email;
    public readonly ?string $password;

    protected function rules(): array
    {
        return [
            "id"       => $this->required($this->userId()),
            "name"     => $this->required($this->string(), $this->uniqueNotDeleted("users", "name")->ignore($this->inputInt("id"))),
            "email"    => $this->required($this->email(), $this->uniqueNotDeleted("users", "email")->ignore($this->inputInt("id"))),
            "password" => $this->nullable($this->passwordConfirmed()),
        ];
    }

    protected function attributes(): array
    {
        return [
            "name"     => ___("login_info.word.name"),
            "email"    => ___("login_info.word.email"),
            "password" => ___("login_info.word.password"),
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
        ];
    }

    protected function bind(): void
    {
        $this->id       = $this->inputInt("id");
        $this->name     = $this->inputString("name");
        $this->email    = $this->inputString("email");
        $this->password = $this->inputNullableString("password");
    }
}
