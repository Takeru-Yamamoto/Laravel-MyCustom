<?php

namespace MyCustom\Utils\File\StorageFiles;

use MyCustom\Utils\File\StorageFileUtil;

use MyCustom\Utils\File\Helpers\FilePathHelper;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

final class ExcelStorageFile extends StorageFileUtil
{
    public Spreadsheet $file;

    public Csv|Xlsx $writer;

    private int $sheetCount;

    private array $sheets;
    private array $sheetNames;
    private array $sheetHighestRowIndexes;
    private array $sheetHighestColumnIndexes;
    private array $sheetRanges;

    private int $targetSheetPage;
    private Worksheet $targetSheet;


    /**
     * 継承先クラスのコンストラクタ
     * StorageFileUtilのコンストラクタで呼び出す
     *
     * @return void
     */
    protected function childConstruct(): void
    {
        $this->file = IOFactory::load($this->storagePath);

        $this->writer = new Xlsx($this->file);

        $this->sheetCount = $this->file->getSheetCount();

        $this->pivotFirst();

        $this->sheets    = [];
        $this->sheetNames = [];
        $this->sheetHighestRowIndexes = [];
        $this->sheetHighestColumnIndexes = [];
        $this->sheetRanges = [];

        for ($i = 0; $i < $this->sheetCount; $i++) {
            $sheet = $this->file->getSheet($i);

            $this->sheets[$i]                    = $sheet;
            $this->sheetNames[$i]                = $sheet->getTitle();
            $this->sheetHighestRowIndexes[$i]    = $sheet->getHighestDataRow();
            $this->sheetHighestColumnIndexes[$i] = $sheet->getHighestDataColumn();
            $this->sheetRanges[$i]               = $sheet->calculateWorksheetDimension();
        }
    }

    /**
     * Excelファイルを保存する
     * StorageFileUtilでabstract宣言されているメソッド
     *
     * @param string $dirName
     * @param string $baseName
     * @return self
     */
    public function create(string $dirName, string $baseName): static
    {
        $this->writer->save(FilePathHelper::filePath($dirName, $baseName));

        return new static($dirName, $baseName);
    }

    /**
     * ExcelファイルをCSVファイルとして保存する
     *
     * @param string $dirName
     * @param string $baseName
     * @return self
     */
    public function createAsCsv(string $dirName, string $baseName): static
    {
        $this->writer = new Csv($this->file);

        return $this->create($dirName, $baseName);
    }


    /**
     * Property Access width 
     *
     * @return array
     */
    public function sheets(): array
    {
        return $this->sheets;
    }

    /**
     * Property Access sheetCount
     *
     * @return int
     */
    public function sheetCount(): int
    {
        return $this->sheetCount;
    }

    /**
     * Property Access sheetNames
     *
     * @return array
     */
    public function sheetNames(): array
    {
        return $this->sheetNames;
    }

    /**
     * Property Access sheetHighestRowIndexes
     *
     * @return array
     */
    public function sheetHighestRowIndexes(): array
    {
        return $this->sheetHighestRowIndexes;
    }

    /**
     * Property Access sheetHighestColumnIndexes
     *
     * @return array
     */
    public function sheetHighestColumnIndexes(): array
    {
        return $this->sheetHighestColumnIndexes;
    }

    /**
     * Property Access sheetRanges
     *
     * @return array
     */
    public function sheetRanges(): array
    {
        return $this->sheetRanges;
    }

    /**
     * Property Access targetSheetPage
     *
     * @return int
     */
    public function targetSheetPage(): int
    {
        return $this->targetSheetPage;
    }

    /**
     * Property Access targetSheet
     *
     * @return Worksheet
     */
    public function targetSheet(): Worksheet
    {
        return $this->targetSheet;
    }


    /**
     * targetSheetのデータを全て取得する
     *
     * @return array
     */
    public function sheetData(): array
    {
        return $this->sheetDataByRange($this->targetSheet->calculateWorksheetDataDimension());
    }

    /**
     * targetSheetのデータを全て取得する
     *
     * @return array
     */
    public function sheetDataBy(string $startColumn = null, int $startRow = null, string $endColumn = null, string $endRow = null): array
    {
        if(is_null($startColumn)) $startColumn = "A";
        if(is_null($startRow)) $startRow = 1;
        if(is_null($endColumn)) $endColumn = $this->targetSheet->getHighestDataColumn();
        if(is_null($endRow)) $endRow = $this->targetSheet->getHighestDataRow();

        $range = $startColumn . $startRow . ":" . $endColumn . $endRow;

        return $this->sheetDataByRange($range);
    }

    /**
     * targetSheetのデータを全て取得する
     *
     * @return array
     */
    public function sheetDataByRange(string $range): array
    {
        return $this->targetSheet->rangeToArray($range);
    }

    /**
     * targetSheetのデータを１行ずつ取得し、クロージャを実行する
     *
     * @param \Closure $closure
     * @param int $startRowIndex
     * @param array $ignoreRowIndex
     * 
     * @return void
     */
    public function sheetDataByRowIndex(\Closure $closure, int $startRowIndex = 1, array $ignoreRowIndex = []): void
    {
        $firstColumn = "A";
        $lastColumn  = $this->targetSheet->getHighestDataColumn();

        for ($rowIndex = $startRowIndex; $rowIndex <= $this->targetSheet->getHighestDataRow(); $rowIndex++) {
            if (in_array($rowIndex, $ignoreRowIndex)) continue;

            $dimension = $firstColumn . $rowIndex . ":" . $lastColumn . $rowIndex;

            $row = $this->targetSheet->rangeToArray($dimension);

            $closure($row[0]);
        }
    }


    /**
     * 操作するシートを選択する
     *
     * @param int|null $page
     * @return self
     */
    public function selectSheet(int $page = null): static
    {
        if (is_null($page)) $page = $this->targetSheetPage;

        if ($page >= 0 && $page < $this->sheetCount) $this->targetSheet = $this->file->getSheet($page);

        return $this;
    }

    /**
     * 選択されているシートのひとつ前のシートを選択する
     *
     * @return self
     */
    public function pivotPrev(): static
    {
        if ($this->targetSheetPage > 0) $this->targetSheetPage--;

        return $this->selectSheet();
    }

    /**
     * 選択されているシートのひとつ後のシートを選択する
     *
     * @return self
     */
    public function pivotNext(): static
    {
        if ($this->targetSheetPage < ($this->sheetCount - 1)) $this->targetSheetPage++;

        return $this->selectSheet();
    }

    /**
     * 最初のシートを選択する
     *
     * @return self
     */
    public function pivotFirst(): static
    {
        $this->targetSheetPage = 0;

        return $this->selectSheet();
    }

    /**
     * 最後のシートを選択する
     *
     * @return self
     */
    public function pivotLast(): static
    {
        $this->targetSheetPage = $this->sheetCount;

        return $this->selectSheet();
    }

    /**
     * シートを追加する
     *
     * @param string $sheetName
     * @return self
     */
    public function addSheet(string $sheetName): static
    {
        $sheet = new Worksheet($this->file, $sheetName);

        $this->file->addSheet($sheet);

        return $this;
    }

    /**
     * 選択されているシートのタイトルを取得する
     *
     * @return string
     */
    public function sheetTitle(): string
    {
        return $this->targetSheet->getTitle();
    }

    /**
     * 選択されているシートのタイトルを設定する
     *
     * @param string $title
     * @return self
     */
    public function setSheetTitle(string $title): static
    {
        $this->targetSheet->setTitle($title);
        return $this;
    }


    /**
     * 選択されているシートのセルの値を取得する
     *
     * @param string $cell
     * @return mixed
     */
    public function cellValue(string $cell): mixed
    {
        return $this->targetSheet->getCell($cell)->getValue();
    }

    /**
     * 選択されているシートのセルの値を設定する
     *
     * @param string $cell
     * @param mixed $value
     * @return self
     */
    public function setCellValue(string $cell, mixed $value): static
    {
        $this->targetSheet->setCellValue($cell, $value);

        return $this;
    }

    /**
     * 選択されているシートのセルの値を範囲指定で取得する
     *
     * @param string|null $range
     * @return array
     */
    public function cellValues(string $range = null): array
    {
        if (is_null($range)) $range = $this->targetSheet->calculateWorksheetDimension();

        return $this->targetSheet->rangeToArray($range, null, true, true, false);
    }

    /**
     * 選択されているシートのセルの値をまとめて設定する
     *
     * @param array $values
     * @param string|null $startCell
     * @return self
     */
    public function setCellValues(array $values, string $startCell = null): static
    {
        $this->targetSheet->fromArray($values, null, $startCell, false);

        return $this;
    }

    /**
     * 選択されているシートのセルの値がnullかどうかを判定する
     *
     * @param string $cell
     * @return bool
     */
    public function cellIsNull(string $cell): bool
    {
        return is_null($this->cellValue($cell));
    }

    /**
     * 選択されているシートのセルを結合する
     *
     * @param string $range
     * @return self
     */
    public function mergeCells(string $range): static
    {
        $this->targetSheet->mergeCells($range);

        return $this;
    }


    /**
     * 選択されているシートの行の高さを取得する
     *
     * @param int $row
     * @return float
     */
    public function rowHeight(int $row): float
    {
        return $this->targetSheet->getRowDimension($row)->getRowHeight();
    }

    /**
     * 選択されているシートの行の高さを設定する
     *
     * @param int $row
     * @param float $height
     * @return self
     */
    public function setRowHeight(int $row, float $height): static
    {
        $this->targetSheet->getRowDimension($row)->setRowHeight($height);

        return $this;
    }

    /**
     * 選択されているシートの列の幅を取得する
     *
     * @param int $column
     * @return float
     */
    public function columnWidth(int $column): float
    {
        return $this->targetSheet->getColumnDimension($column)->getWidth();
    }

    /**
     * 選択されているシートの列の幅を設定する
     *
     * @param int $column
     * @param float $width
     * @return self
     */
    public function setColumnWidth(int $column, float $width): static
    {
        $this->targetSheet->getColumnDimension($column)->setWidth($width);

        return $this;
    }
}
