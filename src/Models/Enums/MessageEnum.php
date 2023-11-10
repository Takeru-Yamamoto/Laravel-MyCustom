<?php

namespace MyCustom\Models\Enums;

use MyCustom\Enums\EnumTrait;

enum MessageEnum: string
{
    case CREATE          = "create";
    case UPDATE          = "update";
    case DELETE          = "delete";
    case RESTORE         = "restore";
    case CHANGE_IS_VALID = "change isValid";

    use EnumTrait;
}
