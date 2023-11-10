<?php

namespace MyCustom\Utils\Http\Enums;

use MyCustom\Enums\EnumTrait;

enum MethodEnum: string
{
    case GET    = "get";
    case POST   = "post";
    case PUT    = "put";
    case DELETE = "delete";
    case HEAD   = "head";
    case PATCH  = "patch";

    use EnumTrait;
}
