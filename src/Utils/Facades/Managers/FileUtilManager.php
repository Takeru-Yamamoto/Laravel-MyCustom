<?php

namespace MyCustom\Utils\Facades\Managers;

use MyCustom\Utils\File\StorageFiles as StorageFile;
use MyCustom\Utils\File\RequestFileUtil;
use MyCustom\Utils\File\StorageFileUtil;
use MyCustom\Utils\File\Enums\FileTypeEnum;
use MyCustom\Utils\File\Helpers\FilePathHelper;

use Illuminate\Http\UploadedFile;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FileUtilManager
{
    public function storage(string $dirName, string $baseName): StorageFileUtil
    {
        $storageFile = match (FileTypeEnum::tryFromStorage($dirName, $baseName)) {
            FileTypeEnum::IMAGE => new StorageFile\ImageStorageFile($dirName, $baseName),
            FileTypeEnum::VIDEO => new StorageFile\VideoStorageFile($dirName, $baseName),
            FileTypeEnum::TEXT  => new StorageFile\TextStorageFile($dirName, $baseName),
            FileTypeEnum::EXCEL => new StorageFile\ExcelStorageFile($dirName, $baseName),

            default             => null
        };

        if (!$storageFile instanceof StorageFileUtil) throw new \RuntimeException("Storage file not supported");

        return $storageFile;
    }

    public function request(UploadedFile|array $files): RequestFileUtil|array
    {
        $requestFiles = [];

        if ($files instanceof UploadedFile) return new RequestFileUtil($files);

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) $requestFiles[] = new RequestFileUtil($file);
        }

        return $requestFiles;
    }

    public function upload(UploadedFile $file, string $dirName, string $registerName = null, bool $isAllowOverwriting = false): StorageFileUtil
    {
        $requestFiles = $this->request($file);

        return $requestFiles->upload($dirName, $registerName, $isAllowOverwriting);
    }

    public function createExcel(string $dirName, string $baseName): StorageFile\ExcelStorageFile
    {
        (new Xlsx(new Spreadsheet()))->save(FilePathHelper::filePath($dirName, $baseName));

        return new StorageFile\ExcelStorageFile($dirName, $baseName);
    }

    public function createCsv(string $dirName, string $baseName): StorageFile\TextStorageFile
    {
        (new Csv(new Spreadsheet()))->save(FilePathHelper::filePath($dirName, $baseName));

        return new StorageFile\TextStorageFile($dirName, $baseName);
    }
}
