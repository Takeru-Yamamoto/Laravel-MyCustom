<?php

namespace MyCustom\Utils\File\Enums;

use MyCustom\Enums\EnumTrait;

use MyCustom\Utils\File\Enums\MimeTypeEnum;

enum FileTypeEnum: string
{
    case IMAGE = "image";
    case VIDEO = "video";
    case TEXT  = "text";
    case EXCEL = "excel";

    use EnumTrait;

    public static function tryFromStorage(string $dirName, string $baseName): ?static
    {
        return match (MimeTypeEnum::tryFromStorage($dirName, $baseName)) {
            MimeTypeEnum::JPG  => self::IMAGE,
            MimeTypeEnum::PNG  => self::IMAGE,
            MimeTypeEnum::WEBP => self::IMAGE,
            MimeTypeEnum::GIF  => self::IMAGE,

            MimeTypeEnum::MPEG => self::VIDEO,
            MimeTypeEnum::MP4  => self::VIDEO,
            MimeTypeEnum::WEBM => self::VIDEO,
            MimeTypeEnum::MOV  => self::VIDEO,
            MimeTypeEnum::AVI  => self::VIDEO,

            MimeTypeEnum::TEXT => self::TEXT,
            MimeTypeEnum::CSV  => self::TEXT,

            MimeTypeEnum::XLS  => self::EXCEL,
            MimeTypeEnum::XLSX => self::EXCEL,

            default => null
        };
    }
}
