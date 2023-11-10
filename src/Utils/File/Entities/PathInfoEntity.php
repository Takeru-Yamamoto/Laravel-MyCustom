<?php

namespace MyCustom\Utils\File\Entities;

final class PathInfoEntity
{
    public readonly string $dirName;
    public readonly string $baseName;
    public readonly string $extension;
    public readonly string $fileName;

    function __construct(string $filePath)
    {
        $pathinfo = pathinfo($filePath);

        $this->dirName   = $pathinfo["dirname"];
        $this->baseName  = $pathinfo["basename"];
        $this->extension = $pathinfo["extension"];
        $this->fileName  = $pathinfo["filename"];
    }
}
