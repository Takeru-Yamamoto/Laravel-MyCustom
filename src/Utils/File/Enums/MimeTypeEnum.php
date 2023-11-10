<?php

namespace MyCustom\Utils\File\Enums;

use MyCustom\Utils\File\Helpers\StorageHelper;

use MyCustom\Enums\EnumTrait;

enum MimeTypeEnum: string
{
    case JPG  = "image/jpeg";
    case PNG  = "image/png";
    case WEBP = "image/webp";
    case GIF  = "image/gif";

    case MPEG = "video/mpeg";
    case MP4  = "video/mp4";
    case WEBM = "video/webm";
    case MOV  = "video/quicktime";
    case AVI  = "video/x-msvideo";

    case TEXT = "text/plain";
    case CSV  = "text/csv";

    case XLS  = "application/vnd.ms-excel";
    case XLSX = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";

    use EnumTrait;

    public static function tryFromStorage(string $dirName, string $baseName): ?static
    {
        $mimeType = StorageHelper::mimeType($dirName, $baseName);

        return self::tryFrom($mimeType);
    }
}
