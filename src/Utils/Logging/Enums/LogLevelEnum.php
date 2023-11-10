<?php

namespace MyCustom\Utils\Logging\Enums;

use MyCustom\Enums\EnumTrait;

enum LogLevelEnum: string
{
    case DEBUG     = "debug";
    case INFO      = "info";
    case NOTICE    = "notice";
    case WARNING   = "warning";
    case ERROR     = "error";
    case CRITICAL  = "critical";
    case ALERT     = "alert";
    case EMERGENCY = "emergency";

    use EnumTrait;
}
