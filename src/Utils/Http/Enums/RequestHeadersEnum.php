<?php

namespace MyCustom\Utils\Http\Enums;

use MyCustom\Enums\EnumTrait;

enum RequestHeadersEnum: string
{
    case ACCEPT        = "Accept";
    case AUTHORIZATION = "Authorization";
    case CONTENT_TYPE  = "Content-Type";

    use EnumTrait;
}
