<?php

namespace MyCustom\Utils\Http\Enums\RequestHeaders;

use MyCustom\Enums\EnumTrait;

enum TokenTypeEnum: string
{
    case BEARER = "Bearer";

    use EnumTrait;
}
