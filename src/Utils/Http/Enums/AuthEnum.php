<?php

namespace MyCustom\Utils\Http\Enums;

use MyCustom\Enums\EnumTrait;

enum AuthEnum: string
{
    case BASIC  = "basic";
    case DIGEST = "digest";

    use EnumTrait;
}
