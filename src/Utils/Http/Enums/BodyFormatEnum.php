<?php

namespace MyCustom\Utils\Http\Enums;

use MyCustom\Enums\EnumTrait;

enum BodyFormatEnum: string
{
    case BODY      = "body";
    case JSON      = "json";
    case FORM      = "form_params";
    case MULTIPART = "multipart";

    use EnumTrait;
}
