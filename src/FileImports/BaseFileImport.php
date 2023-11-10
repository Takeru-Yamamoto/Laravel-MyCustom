<?php

namespace MyCustom\FileImports;

use MyCustom\Utils\Facades\File;
use MyCustom\Utils\File\StorageFileUtil;

use MyCustom\Utils\Facades\Logging;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

abstract class BaseFileImport
{
    /**
     * Import Dataを一括でUpsertする際のLimit定数
     */
    protected const BULK_LIMIT = 1000;

    /**
     * errorOccurred()でExceptionをthrowするかどうか
     */
    protected const IS_IMPORT_STRICT = false;

    /**
     * FileをImportする際に使用するModelのクラス名
     *
     * @var string
     */
    protected string $modelClass;

    /**
     * Importに使用するStorageFileのクラス名
     *
     * @var string
     */
    protected string $storageFileClass;

    /**
     * データベースにUpsertするデータ配列
     *
     * @var array
     */
    private array $fileData = [];

    /**
     * データベースにUpsertするデータ配列のバッファー
     *
     * @var array
     */
    private array $dataBuffer = [];

    /**
     * バリデーションの結果、エラーとなったデータ配列
     *
     * @var array
     */
    private array $failedImportData = [];

    /**
     * fileDataをUpsertした件数
     *
     * @var int
     */
    private int $count = 0;


    function __construct(string $dirName, string $baseName)
    {
        $fileUtil = File::storage($dirName, $baseName);

        if (!$fileUtil instanceof $this->storageFileClass) throw new \RuntimeException("Storage file not supported");

        $this->fileData = $this->createFileData($fileUtil);
    }


    /**
     * データベースのテーブルをtruncateする
     *
     * @return self
     */
    final public function truncateTable(): static
    {
        DB::table($this->model()->getTable())->truncate();

        return $this;
    }


    /* Bulk Upsert */
    /**
     * fileDataをデータベースにBulkUpsertする
     *
     * @return void
     */
    final public function bulkUpsert(): void
    {
        if (empty($this->fileData)) throw new \RuntimeException("File data is empty");

        foreach ($this->fileData as $row) {
            $this->beforeValidation();

            if (!$this->validation($row)) {
                $this->errorOccurred($row);
                continue;
            }

            $this->beforeCreateImportData();

            $this->dataBuffer[] = $this->createImportData($row);

            if ($this->isReachedBulkLimit()) $this->upsert();
        }

        $this->upsert();
    }

    /**
     * BulkUpsertの際にBulkLimitに達したかどうか
     *
     * @return bool
     */
    private function isReachedBulkLimit(): bool
    {
        return count($this->dataBuffer) >= static::BULK_LIMIT;
    }

    /**
     * BulkUpsertを実行する
     *
     * @return void
     */
    private function upsert(): void
    {
        $this->modelClass::upsert($this->dataBuffer, $this->uniqueBy());

        $this->count += count($this->dataBuffer);

        $this->dataBuffer = [];
    }

    /**
     * BulkUpsertの前処理
     * 何かしらの処理を行いたい場合はオーバーライドする
     *
     * @return void
     */
    protected function beforeValidation(): void
    {
    }

    /**
     * fileDataからデータベースにUpsertするデータ配列を生成する前処理
     * 何かしらの処理を行いたい場合はオーバーライドする
     *
     * @return void
     */
    protected function beforeCreateImportData(): void
    {
    }


    /**
     * Model Access
     *
     * @return Model
     */
    final public function model(): Model
    {
        return new $this->modelClass;
    }

    /**
     * Property Access fileData
     *
     * @return array
     */
    final public function fileData(): array
    {
        return $this->fileData;
    }

    /**
     * Property Access failedImportData
     *
     * @return array
     */
    final public function failedImportData(): array
    {
        return $this->failedImportData;
    }

    /**
     * Property Access count
     *
     * @return int
     */
    final public function count(): int
    {
        return $this->count;
    }


    /**
     * バリデーションに失敗したデータ配列を格納する
     * IS_IMPORT_STRICTがtrueの場合はExceptionをthrowする
     * そうでない場合はログを出力する
     *
     * @param mixed $row
     * @return void
     */
    final protected function errorOccurred(mixed $row): void
    {
        $this->failedImportData[] = $row;

        static::IS_IMPORT_STRICT ? throw new \RuntimeException("Invalid import data") : $this->invalidImportDataLog($row);
    }

    /**
     * エラー発生時にログを出力する
     *
     * @param mixed $row
     * @return void
     */
    final protected function invalidImportDataLog(mixed $row): void
    {
        Logging::errorLog("Invalid Import Data: " . jsonEncode($row));
    }

    /**
     * StorageFileからfileDataを生成する
     *
     * @param StorageFileUtil $fileUtil
     * @return array
     */
    abstract protected function createFileData(StorageFileUtil $fileUtil): array;

    /**
     * fileDataのバリデーションを行う
     *
     * @param array $row
     * @return bool
     */
    abstract protected function validation(array $row): bool;

    /**
     * fileDataからデータベースにUpsertするデータ配列を生成する
     *
     * @param array $row
     * @return array
     */
    abstract protected function createImportData(array $row): array;

    /**
     * データベースにUpsertする際のUnique条件を指定する
     *
     * @return array|string
     */
    abstract protected function uniqueBy(): array|string;
}
