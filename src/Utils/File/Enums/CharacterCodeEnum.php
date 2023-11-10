<?php

namespace MyCustom\Utils\File\Enums;

use MyCustom\Enums\EnumTrait;

enum CharacterCodeEnum: string
{
    case UTF8      = "UTF-8";
    case EUCJP_WIN = "eucJP-win";
    case SJIS_WIN  = "SJIS-win";
    case ASCII     = "ASCII";
    case EUC_JP    = "EUC-JP";
    case SJIS      = "SJIS";
    case JIS       = "JIS";

    use EnumTrait;
}
