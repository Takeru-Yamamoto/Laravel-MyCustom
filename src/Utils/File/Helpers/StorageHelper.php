<?php

namespace MyCustom\Utils\File\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Symfony\Component\HttpFoundation\StreamedResponse;

final class StorageHelper
{
    public static function moldingFilePath(string $dirName): string
    {
        return match (true) {
            str_contains($dirName, "public") => $dirName,
            empty($dirName) || $dirName === DIRECTORY_SEPARATOR => "public",

            default => "public" . DIRECTORY_SEPARATOR . $dirName,
        };
    }

    public static function fileUpload(UploadedFile $file, string $dirName, string $registerName): string|false
    {
        return $file->storeAs(self::moldingFilePath($dirName), $registerName);
    }

    public static function mimeType(string $dirName, string $baseName): string
    {
        return Storage::mimeType(self::moldingFilePath($dirName) . DIRECTORY_SEPARATOR . $baseName);
    }

    public static function download(string $dirName, string $baseName): StreamedResponse
    {
        return Storage::download(self::moldingFilePath($dirName) . DIRECTORY_SEPARATOR . $baseName);
    }

    public static function delete(string $dirName, string $baseName): bool
    {
        return Storage::delete(self::moldingFilePath($dirName) . DIRECTORY_SEPARATOR . $baseName);
    }

    public static function isExist(string $dirName, string $baseName): bool
    {
        return Storage::exists(self::moldingFilePath($dirName) . DIRECTORY_SEPARATOR . $baseName);
    }

    public static function size(string $dirName, string $baseName): string
    {
        return Storage::size(self::moldingFilePath($dirName) . DIRECTORY_SEPARATOR . $baseName);
    }
}
