<?php

namespace App\Http\Forms\Auth\PasswordForgot;

use MyCustom\Http\Forms\BaseForm;

final class PasswordResetPreparationForm extends BaseForm
{
    public readonly string $token;
    public readonly string $email;

    protected function prepareValidation(): void
    {
        $this->decryptParams("crypted");
    }

    protected function validationFailed(): void
    {
        $this->validationFailureRoute("showLoginForm", messages: ["crypted" => __("mycustom.message.cant_decrypt")]);
    }

    protected function rules(): array
    {
        return [
            "token" => $this->required($this->string(), $this->existsNotDeleted("password_reset_tokens", "token")->where("email", $this->input("email"))),
            "email" => $this->required($this->email(), $this->existsNotDeleted("password_reset_tokens", "email")->where("token", $this->input("token"))),
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
        $this->token = strval($this->input("token"));
        $this->email = strval($this->input("email"));
    }
}
