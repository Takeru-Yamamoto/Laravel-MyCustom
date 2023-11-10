<?php

namespace MyCustom\Utils\File\Enums;

use MyCustom\Utils\File\Helpers\FilePathHelper;

use MyCustom\Enums\EnumTrait;

enum FilePathEnum: string
{
    case PURE    = "pure";
    case STORAGE = "storage";
    case PUBLIC  = "public";
    case ASSET   = "asset";

    use EnumTrait;

    public function filePath(string $dirName, string $baseName): string
    {
        return match ($this) {
            self::PURE    => FilePathHelper::filePath($dirName, $baseName),
            self::STORAGE => FilePathHelper::storagePath($dirName, $baseName),
            self::PUBLIC  => FilePathHelper::publicPath($dirName, $baseName),
            self::ASSET   => FilePathHelper::assetURL($dirName, $baseName),
        };
    }
}
