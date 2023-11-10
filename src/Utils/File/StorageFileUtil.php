<?php

namespace MyCustom\Utils\File;

use MyCustom\Jsonables\BaseJsonable;

use MyCustom\Utils\File\Helpers\FilePathHelper;
use MyCustom\Utils\File\Helpers\StorageHelper;

abstract class StorageFileUtil extends BaseJsonable
{
    public readonly string $dirName;
    public readonly string $baseName;
    public readonly string $fileName;
    public readonly string $extension;

    public readonly string $filePath;
    public readonly string $storagePath;
    public readonly string $publicPath;
    public readonly string $assetUrl;

    public readonly string $mimeType;
    public readonly int $size;


    /**
     * コンストラクタ
     * childConstruct()を呼び出す
     *
     * @param string $dirName
     * @param string $baseName
     */
    function __construct(string $dirName, string $baseName)
    {
        $this->dirName   = $dirName;
        $this->baseName  = $baseName;

        $pathInfoEntity = FilePathHelper::storagePathInfo($dirName, $baseName);

        $this->fileName  = $pathInfoEntity->fileName;
        $this->extension = $pathInfoEntity->extension;

        $this->filePath    = FilePathHelper::filePath($dirName, $baseName);
        $this->storagePath = FilePathHelper::storagePath($dirName, $baseName);
        $this->publicPath  = FilePathHelper::publicPath($dirName, $baseName);
        $this->assetUrl    = FilePathHelper::assetUrl($dirName, $baseName);

        $this->mimeType  = StorageHelper::mimeType($dirName, $baseName);
        $this->size      = StorageHelper::size($dirName, $baseName);

        $this->childConstruct();
    }

    /**
     * 継承先クラスのコンストラクタ
     * StorageFileUtilのコンストラクタで呼び出す
     *
     * @return void
     */
    abstract protected function childConstruct(): void;

    /**
     * ファイルを保存する
     * 各StorageFileUtilで実態を定義する
     *
     * @param string $dirName
     * @param string $baseName
     * @return self
     */
    abstract public function create(string $dirName, string $baseName): static;

    /**
     * ファイルを上書き保存する
     *
     * @return self
     */
    final public function save(): static
    {
        return $this->create($this->dirName, $this->baseName);
    }

    /**
     * ファイルを別名で保存する
     *
     * @param string $registerName
     * @return self
     */
    final public function saveAs(string $registerName): static
    {
        return $this->create($this->dirName, $registerName);
    }

    /**
     * ファイルを削除する
     *
     * @return self
     */
    final public function delete(): static
    {
        StorageHelper::delete($this->dirName, $this->baseName);
        return $this;
    }

    /**
     * ファイルを移動する
     *
     * @param string $dirName
     * @param string $baseName
     * @return self
     */
    final public function move(string $dirName, string $baseName): static
    {
        $this->create($dirName, $baseName)->delete();

        return new static($dirName, $baseName);
    }

    /**
     * ファイルを別名で移動する
     *
     * @param string $baseName
     * @return self
     */
    final public function moveAs(string $baseName): static
    {
        return $this->move($this->dirName, $baseName);
    }

    /**
     * ファイルを別ディレクトリに移動する
     *
     * @param string $dirName
     * @return self
     */
    final public function moveDirectory(string $dirName): static
    {
        return $this->move($dirName, $this->baseName);
    }

    /**
     * ファイルをディレクトリ内のtmpディレクトリに移動する
     *
     * @return self
     */
    final public function moveToTmp(): static
    {
        return $this->moveDirectory($this->dirName . DIRECTORY_SEPARATOR . "tmp");
    }

    /**
     * ファイルをディレクトリ内のtmpディレクトリから移動する
     *
     * @return self
     */
    final public function moveFromTmp(): static
    {
        return $this->moveDirectory(str_replace(DIRECTORY_SEPARATOR . "tmp", "", $this->dirName));
    }
}
