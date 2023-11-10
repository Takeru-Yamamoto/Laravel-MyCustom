<?php

namespace App\Http\Forms\LoginInfo;

use MyCustom\Http\Forms\BaseForm;

final class ChangeEmailForm extends BaseForm
{
    public readonly int $userId;
    public readonly string $authenticationCode;

    protected function rules(): array
    {
        return [
            "user_id"             => $this->required($this->userId(), $this->existsNotDeleted("email_resets", "user_id")->where("authentication_code", $this->inputString("authentication_code"))),
            "authentication_code" => $this->required($this->code(6), $this->existsNotDeleted("email_resets", "authentication_code")->where("user_id", $this->inputInt("user_id"))),
        ];
    }

    protected function attributes(): array
    {
        return [
            "user_id"             => ___("login_info.word.user_id"),
            "authentication_code" => ___("login_info.word.authentication_code"),
        ];
    }

    protected function messages(): array
    {
        return [
            "user_id.required" => ":attributeは必ず指定してください。",
            "user_id.integer"  => ":attributeは整数で指定してください。",
            "user_id.exists"   => "指定された:attributeは存在しません。",

            "authentication_code.required" => ":attributeは必ず指定してください。",
            "authentication_code.string"   => ":attributeが正しくありません。",
            "authentication_code.regex"    => ":attributeが正しくありません。",
            "authentication_code.exists"   => ":attributeが正しくありません。",
        ];
    }

    protected function bind(): void
    {
        $this->userId             = $this->inputInt("user_id");
        $this->authenticationCode = $this->inputString("authentication_code");
    }
}
