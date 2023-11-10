<?php

namespace MyCustom\Utils\File\StorageFiles;

use MyCustom\Utils\File\StorageFileUtil;

use MyCustom\Utils\File\Helpers\FilePathHelper;
use MyCustom\Utils\File\Enums\ExtensionEnum;

use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use ProtoneMedia\LaravelFFMpeg\MediaOpener;
use ProtoneMedia\LaravelFFMpeg\Filters\WatermarkFactory;

use FFMpeg\Format\FormatInterface;
use FFMpeg\Format\Video\X264;
use FFMpeg\Format\Video\WebM;

final class VideoStorageFile extends StorageFileUtil
{
    public MediaOpener $file;

    private int $width;
    private int $height;
    private int $seconds;

    private ?FormatInterface $format;
    private ?\Closure $watermark;
    private ?int $resizeWidth;
    private ?int $resizeHeight;
    private \Closure|array|null $filter;
    private ?\Closure $progressCallback;

    /**
     * 継承先クラスのコンストラクタ
     * StorageFileUtilのコンストラクタで呼び出す
     *
     * @return void
     */
    protected function childConstruct(): void
    {
        $this->file = FFMpeg::open($this->filePath);

        $stream        = $this->file->getVideoStream();
        $this->width   = $stream->get("width");
        $this->height  = $stream->get("height");
        $this->seconds = $stream->getDurationInSeconds();

        $this->progressCallback = null;
    }

    /**
     * 動画を保存する
     * StorageFileUtilでabstract宣言されているメソッド
     *
     * @param string $dirName
     * @param string $baseName
     * @return self
     */
    public function create(string $dirName, string $baseName): static
    {
        $exporter = $this->file->export();

        if (!is_null($this->format)) $exporter = $exporter->inFormat($this->format);

        if (!is_null($this->watermark)) $exporter = $exporter->addWatermark($this->watermark);

        if (!is_null($this->resizeWidth) && !is_null($this->resizeHeight)) $exporter = $exporter->addFilter(function ($filters) {
            $filters->resize(new \FFMpeg\Coordinate\Dimension($this->resizeWidth, $this->resizeHeight));
        });

        if (!is_null($this->filter)) $exporter = $exporter->addFilter($this->filter);

        if (!is_null($this->progressCallback)) $exporter = $exporter->onProgress($this->progressCallback);

        $exporter->save(FilePathHelper::fileTemporaryPath($dirName, $baseName));

        rename(FilePathHelper::storageTemporaryPath($dirName, $baseName), FilePathHelper::storagePath($dirName, $baseName));

        return new static($dirName, $baseName);
    }


    /**
     * Property Access width 
     *
     * @return int
     */
    public function width(): int
    {
        return $this->width;
    }

    /**
     * Property Access height 
     *
     * @return int
     */
    public function height(): int
    {
        return $this->height;
    }

    /**
     * Property Access seconds 
     *
     * @return int
     */
    public function seconds(): int
    {
        return $this->seconds;
    }


    /**
     * 動画のフォーマットクラスを返却する
     *
     * @param ExtensionEnum $format
     * @return FormatInterface
     */
    private function format(ExtensionEnum $format): FormatInterface
    {
        return match ($format) {
            ExtensionEnum::MP4  => new X264("libmp3lame", "libx264"),
            ExtensionEnum::MOV  => new X264("libmp3lame", "libx264"),
            ExtensionEnum::WEBM => new WebM(),
        };
    }

    /**
     * 動画をエンコードする
     *
     * @param ExtensionEnum $extension
     * @return self
     */
    private function encode(ExtensionEnum $extension): static
    {
        $this->format = $this->format($extension);

        return $this->saveAs($this->fileName . "." . $extension);
    }

    /**
     * 動画をMP4形式にエンコードする
     *
     * @return self
     */
    public function encodeMP4(): static
    {
        return $this->encode(ExtensionEnum::MP4);
    }

    /**
     * 動画をMOV形式にエンコードする
     *
     * @return self
     */
    public function encodeMOV(): static
    {
        return $this->encode(ExtensionEnum::MOV);
    }

    /**
     * 動画をWEBM形式にエンコードする
     *
     * @return self
     */
    public function encodeWEBM(): static
    {
        return $this->encode(ExtensionEnum::WEBM);
    }


    /**
     * 実行中に呼び出されるコールバック関数を設定する
     *
     * @param \Closure $progressCallback
     * @return self
     */
    public function onProgress(\Closure $progressCallback): static
    {
        $this->progressCallback = $progressCallback;

        return $this;
    }

    /**
     * 動画をリサイズする
     *
     * @param integer $resizeWidth
     * @param integer $resizeHeight
     * @return self
     */
    public function resize(int $resizeWidth, int $resizeHeight): static
    {
        $this->resizeWidth  = $resizeWidth;
        $this->resizeHeight = $resizeHeight;

        return $this;
    }

    /**
     * 動画にロゴを追加する
     *
     * @param \Closure $watermark
     * @return self
     */
    public function watermark(\Closure $watermark): static
    {
        $this->watermark = $watermark;

        return $this;
    }

    /**
     * 動画にロゴを追加するWatermarkFactoryを返却する
     *
     * @return WatermarkFactory
     */
    public function watermarkFactory(): WatermarkFactory
    {
        return new WatermarkFactory;
    }

    /**
     * 動画にフィルターを追加する
     *
     * @param \Closure|array $filter
     * @return self
     */
    public function filter(\Closure|array $filter): static
    {
        $this->filter = $filter;

        return $this;
    }
}
