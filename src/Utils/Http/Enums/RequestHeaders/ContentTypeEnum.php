<?php

namespace MyCustom\Utils\Http\Enums\RequestHeaders;

use MyCustom\Enums\EnumTrait;

enum ContentTypeEnum: string
{
    case JSON = "application/json";
    case FORM = "application/x-www-form-urlencoded";
    case HTML = "text/html";

    use EnumTrait;
}
