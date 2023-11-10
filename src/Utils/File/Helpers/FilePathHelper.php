<?php

namespace MyCustom\Utils\File\Helpers;

use MyCustom\Utils\File\Entities\PathInfoEntity;

final class FilePathHelper
{
    public const DEFAULT_INCLUDE_PATH = "public";

    public static function filePath(string $dirName, string $baseName, string $includePath = self::DEFAULT_INCLUDE_PATH): string
    {
        $isValidIncludePath = !empty($includePath) && $includePath !== DIRECTORY_SEPARATOR;
        $isValidDirName     = !empty($dirName) && $dirName !== DIRECTORY_SEPARATOR;

        if (!$isValidIncludePath && !$isValidDirName) return $baseName;

        if (!$isValidIncludePath) return $dirName . DIRECTORY_SEPARATOR . $baseName;

        if (!$isValidDirName) return $isValidIncludePath . DIRECTORY_SEPARATOR . $baseName;

        return str_contains($dirName, $includePath) ? $dirName . DIRECTORY_SEPARATOR . $baseName : $includePath . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $baseName;
    }

    public static function storagePath(string $dirName, string $baseName): string
    {
        return storage_path(self::filePath($dirName, $baseName, "app" . DIRECTORY_SEPARATOR . "public"));
    }

    public static function publicPath(string $dirName, string $baseName): string
    {
        return public_path(self::filePath($dirName, $baseName, "storage"));
    }

    public static function assetURL(string $dirName, string $baseName): string
    {
        return asset(self::filePath($dirName, $baseName, "storage"));
    }


    public static function fileTemporaryPath(string $dirName, string $baseName, string $includePath = self::DEFAULT_INCLUDE_PATH): string
    {
        return self::filePath($dirName . DIRECTORY_SEPARATOR . "tmp", $baseName, $includePath);
    }

    public static function storageTemporaryPath(string $dirName, string $baseName): string
    {
        return self::storagePath($dirName . DIRECTORY_SEPARATOR . "tmp", $baseName);
    }

    public static function publicTemporaryPath(string $dirName, string $baseName): string
    {
        return self::publicPath($dirName . DIRECTORY_SEPARATOR . "tmp", $baseName);
    }

    public static function assetTemporaryURL(string $dirName, string $baseName): string
    {
        return self::assetURL($dirName . DIRECTORY_SEPARATOR . "tmp", $baseName);
    }


    public static function pathInfo(string $filePath): PathInfoEntity
    {
        return new PathInfoEntity($filePath);
    }

    public static function filePathInfo(string $dirName, string $baseName, string $includePath = self::DEFAULT_INCLUDE_PATH): PathInfoEntity
    {
        return self::pathInfo(self::filePath($dirName, $baseName, $includePath));
    }

    public static function storagePathInfo(string $dirName, string $baseName): PathInfoEntity
    {
        return self::pathInfo(self::storagePath($dirName, $baseName));
    }

    public static function publicPathInfo(string $dirName, string $baseName): PathInfoEntity
    {
        return self::pathInfo(self::publicPath($dirName, $baseName));
    }
}
