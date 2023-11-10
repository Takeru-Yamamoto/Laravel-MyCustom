<?php

namespace MyCustom\Utils\File\Enums;

use MyCustom\Utils\File\Helpers\FilePathHelper;

use MyCustom\Enums\EnumTrait;

enum ExtensionEnum: string
{
    case JPG  = "jpg";
    case PNG  = "png";
    case WEBP = "webp";
    case GIF  = "gif";

    case MPEG = "mpeg";
    case MP4  = "mp4";
    case MOV  = "mov";
    case AVI  = "avi";
    case WEBM = "webm";

    case TEXT = "txt";
    case CSV  = "csv";

    case XLS  = "xls";
    case XLSX = "xlsx";

    use EnumTrait;

    public static function tryFromStorage(string $dirName, string $baseName): ?static
    {
        $pathInfo = FilePathHelper::storagePathInfo($dirName, $baseName);

        return self::tryFrom($pathInfo->extension);
    }
}
