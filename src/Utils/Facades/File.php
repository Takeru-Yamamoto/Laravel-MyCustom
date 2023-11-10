<?php

namespace MyCustom\Utils\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \MyCustom\Utils\File\StorageFileUtil storage(string $dirName, string $baseName)
 * @method static \MyCustom\Utils\File\RequestFileUtil|array request(UploadedFile|array $files)
 * @method static \MyCustom\Utils\File\StorageFileUtil upload(UploadedFile $file, string $dirName, string $registerName = null, bool $isAllowOverwriting = false)
 * @method static \MyCustom\Utils\File\StorageFile\ExcelStorageFile createExcel(string $dirName, string $baseName)
 * @method static \MyCustom\Utils\File\StorageFile\TextStorageFile createCsv(string $dirName, string $baseName)
 * 
 * @see \MyCustom\Utils\Facades\Managers\FileUtilManager
 */
class File extends Facade
{
    /** 
     * Get the registered name of the component. 
     * 
     * @return string 
     */
    protected static function getFacadeAccessor()
    {
        return "FileUtil";
    }
}
