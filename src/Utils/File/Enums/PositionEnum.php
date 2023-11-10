<?php

namespace MyCustom\Utils\File\Enums;

use MyCustom\Enums\EnumTrait;

enum PositionEnum: string
{
    case TOP          = "top";
    case CENTER       = "center";
    case BOTTOM       = "bottom";
    case LEFT         = "left";
    case RIGHT        = "right";
    case TOP_LEFT     = "top-left";
    case TOP_RIGHT    = "top-right";
    case BOTTOM_LEFT  = "bottom-left";
    case BOTTOM_RIGHT = "bottom-right";

    use EnumTrait;
}
