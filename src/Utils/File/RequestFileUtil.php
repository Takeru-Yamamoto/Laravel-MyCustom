<?php

namespace MyCustom\Utils\File;

use MyCustom\Jsonables\BaseJsonable;

use Illuminate\Http\UploadedFile;

use MyCustom\Utils\File\StorageFileUtil;
use MyCustom\Utils\File\StorageFiles as StorageFile;
use MyCustom\Utils\File\Enums\FileTypeEnum;
use MyCustom\Utils\File\Helpers\StorageHelper;

final class RequestFileUtil extends BaseJsonable
{
    public readonly UploadedFile $file;

    public readonly string $baseName;
    public readonly string $mimeType;
    public readonly int $size;
    public readonly string $extension;

    function __construct(UploadedFile $file)
    {
        $this->file = $file;

        $this->baseName  = $file->getClientOriginalName();
        $this->mimeType  = $file->getClientMimeType();
        $this->size      = $file->getSize();
        $this->extension = $file->extension();
    }

    final public function upload(string $dirName, string $registerName = null, bool $isAllowOverwriting = false): StorageFileUtil
    {
        if (is_null($registerName)) $registerName = $this->baseName;

        if (!$isAllowOverwriting) $registerName = $this->avoidDuplicationName($dirName, $registerName);

        StorageHelper::fileUpload($this->file, $dirName, $registerName);

        $storageFile = match (FileTypeEnum::tryFromStorage($dirName, $registerName)) {
            FileTypeEnum::IMAGE => new StorageFile\ImageStorageFile($dirName, $registerName),
            FileTypeEnum::VIDEO => new StorageFile\VideoStorageFile($dirName, $registerName),
            FileTypeEnum::TEXT  => new StorageFile\TextStorageFile($dirName, $registerName),
            FileTypeEnum::EXCEL => new StorageFile\ExcelStorageFile($dirName, $registerName),

            default             => null
        };

        if (is_null($storageFile)) {
            StorageHelper::delete($dirName, $registerName);
            throw new \RuntimeException("Storage file not supported");
        }

        return $storageFile;
    }

    private function avoidDuplicationName(string $dirName, string $registerName): string
    {
        $exploded = explode(".", $registerName);

        for ($i = 1; StorageHelper::isExist($dirName, $registerName); $i++) {
            $registerName = match (str_contains($registerName, "(" . $i . ")")) {
                true  => str_replace("(" . $i . ")", "(" . ($i + 1) . ")", $registerName),
                false => $exploded[0] . "(" . $i . ")." . $exploded[1],
            };
        }

        return $registerName;
    }
}
