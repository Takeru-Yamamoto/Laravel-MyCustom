<?php

namespace MyCustom\Utils\File\StorageFiles;

use MyCustom\Utils\File\StorageFileUtil;

use MyCustom\Utils\File\Enums\ExtensionEnum;
use MyCustom\Utils\File\Enums\PositionEnum;

use MyCustom\Utils\File\Helpers\FilePathHelper;

use Intervention\Image\Facades\Image as FacadeImage;
use Intervention\Image\Image;

final class ImageStorageFile extends StorageFileUtil
{
    public Image $file;

    private int $width;
    private int $height;


    /**
     * 継承先クラスのコンストラクタ
     * StorageFileUtilのコンストラクタで呼び出す
     *
     * @return void
     */
    protected function childConstruct(): void
    {
        $this->file = FacadeImage::make($this->storagePath);

        $this->width    = $this->file->width();
        $this->height   = $this->file->height();
    }

    /**
     * 画像を保存する
     * StorageFileUtilでabstract宣言されているメソッド
     *
     * @param string $dirName
     * @param string $baseName
     * @return self
     */
    public function create(string $dirName, string $baseName): static
    {
        $this->file->save(FilePathHelper::storagePath($dirName, $baseName));

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
     * 画像を他の形式に変換する
     *
     * @param ExtensionEnum $extension: 変換後の拡張子
     * @param int $quality            : 画質
     * @return self
     */
    private function encode(ExtensionEnum $extension, int $quality = 100): static
    {
        $this->file = $this->file->encode($extension->value, $quality);

        return $this->move($this->dirName, $this->fileName . "." . $extension);
    }

    /**
     * 画像をJPG形式に変換する
     *
     * @param int $quality: 画質
     * @return self
     */
    public function encodeJPG(int $quality = 100): static
    {
        return $this->encode(ExtensionEnum::JPG, $quality);
    }

    /**
     * 画像をPNG形式に変換する
     *
     * @return self
     */
    public function encodePNG(): static
    {
        return $this->encode(ExtensionEnum::PNG);
    }

    /**
     * 画像をGIF形式に変換する
     *
     * @return self
     */
    public function encodeGIF(): static
    {
        return $this->encode(ExtensionEnum::GIF);
    }

    /**
     * 画像をWEBP形式に変換する
     *
     * @return self
     */
    public function encodeWEBP(): static
    {
        return $this->encode(ExtensionEnum::WEBP);
    }


    /**
     * 画像をトリミングする
     *
     * @param int $width : トリミングする範囲の横幅
     * @param int $height: トリミングする範囲の高さ
     * @param int $x     : トリミングを開始するx座標
     * @param int $y     : トリミングを開始するy座標
     * @return self
     */
    public function crop(int $width, int $height, int $x = 0, int $y = 0): static
    {
        $this->file = $this->file->crop($width, $height, $x, $y);

        return $this;
    }


    /**
     * 画像のサイズを変更する
     *
     * @param int|null $width : 変更後の画像の横幅
     * @param int|null $height: 変更後の画像の高さ
     * @return self
     */
    public function resize(?int $width, ?int $height): static
    {
        $this->file = $this->file->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        return $this;
    }

    /**
     * 画像のサイズを垂直方向に変更する
     *
     * @param int|null $height: 変更後の画像の高さ
     * @return self
     */
    public function resizeVertical(int $height): static
    {
        return $this->resize(null, $height);
    }

    /**
     * 画像のサイズを水平方向に変更する
     *
     * @param int|null $width: 変更後の画像の横幅
     * @return self
     */
    public function resizeHorizontal(int $width): static
    {
        return $this->resize($width, null);
    }


    /**
     * キャンバスサイズを変更する
     *
     * @param int $width            : 変更後のキャンバスサイズの横幅
     * @param int $height           : 変更後のキャンバスサイズの高さ
     * @param PositionEnum $position: キャンバスサイズ変更の基準点
     * @return self
     */
    public function resizeCanvas(int $width, int $height, PositionEnum $position = PositionEnum::CENTER): static
    {
        $this->file = $this->file->resizeCanvas($width, $height, $position->value, true);

        return $this;
    }


    /**
     * 画像を歪まないようにトリミングする
     *
     * @param int $width            : トリミングする範囲の横幅
     * @param int $height           : トリミングする範囲の高さ
     * @param PositionEnum $position: トリミングする範囲の基準点
     * @return self
     */
    public function fit(int $width, int $height, PositionEnum $position = PositionEnum::CENTER): static
    {
        $this->file = $this->file->fit($width, $height, null, $position->value);

        return $this;
    }


    /**
     * 画像を重ねる
     *
     * @param string $dirName       : 重ねる画像のディレクトリパス
     * @param string $baseName      : 重ねる画像のファイル名
     * @param PositionEnum $position: 重ねる画像を配置する基準点
     * @param int $x                : 重ねる画像を配置する基準点からの水平距離
     * @param int $y                : 重ねる画像を配置する基準点からの垂直距離
     * @return self
     */
    public function insert(string $dirName, string $baseName, PositionEnum $position = PositionEnum::TOP_LEFT, int $x = 0, int $y = 0): static
    {
        $insert = new static($dirName, $baseName);

        $this->file = $this->file->insert($insert->file, $position->value, $x, $y);

        return $this;
    }


    /**
     * 画像を上下反転させる
     *
     * @return self
     */
    public function flipVertical(): static
    {
        $this->file = $this->file->flip("v");

        return $this;
    }

    /**
     * 画像を左右反転させる
     *
     * @return self
     */
    public function flipHorizontal(): static
    {
        $this->file = $this->file->flip("h");

        return $this;
    }


    /**
     * 画像をモノクロにする
     *
     * @return self
     */
    public function greyScale(): static
    {
        $this->file = $this->file->greyscale();

        return $this;
    }


    /**
     * 画像の色を反転させる
     *
     * @return self
     */
    public function colorInvert(): static
    {
        $this->file = $this->file->invert();

        return $this;
    }


    /**
     * 画像の色を変更する
     * 
     * @param int $count    : 画像に使用する色数
     * @param mixed $matte  : 透過させたい色のカラーコード
     * @return self
     */
    public function colorLimit(int $count, mixed $matte = null): static
    {
        $this->file = $this->file->limitColors($count, $matte);

        return $this;
    }


    /**
     * 画像をぼかす
     * 
     * 0  : ほとんどぼかさない
     * 100: 最大限ぼかす
     *
     * @param int $amount
     * @return self
     */
    public function blur(int $amount): static
    {
        if ($amount < 0 || $amount > 100) return $this;

        $this->file = $this->file->blur($amount);

        return $this;
    }


    /**
     * 画像を透過させる
     * 
     * 0  : 何も見えなくなる
     * 100: 透過無し
     *
     * @param int $transparency
     * @return self
     */
    public function opacity(int $transparency): static
    {
        if ($transparency < 0 || $transparency > 100) return $this;

        $this->file = $this->file->opacity($transparency);

        return $this;
    }


    /**
     * 画像にガンマ補正をする
     *
     * @param float $correction: ガンマ補正値
     * @return self
     */
    public function gamma(float $correction): static
    {
        $this->file = $this->file->gamma($correction);

        return $this;
    }


    /**
     * 画像にモザイク処理をする
     * 
     * @param int $size: 大きいほどモザイク処理がきつくなる
     * @return self
     */
    public function pixelate(int $size): static
    {
        $this->file = $this->file->pixelate($size);

        return $this;
    }


    /**
     * 画像を鮮明にする
     * 
     * 0  : ほとんど鮮明にしない
     * 100: 最大限鮮明にする
     *
     * @param int $amount
     * @return self
     */
    public function sharpen(int $amount): static
    {
        if ($amount < 0 || $amount > 100) return $this;

        $this->file = $this->file->sharpen($amount);

        return $this;
    }


    /**
     * 画像の明るさを変更する
     * 
     * -100: 最大限暗くする
     * 0   : そのまま
     * 100 : 最大限明るくする
     *
     * @param int $level
     * @return self
     */
    public function brightness(int $level): static
    {
        if ($level < -100 || $level > 100) return $this;

        $this->file = $this->file->brightness($level);

        return $this;
    }


    /**
     * 画像のコントラストを変更する
     * 
     * -100: 最大限コントラストを減らす
     * 0   : そのまま
     * 100 : 最大限コントラストを増やす
     *
     * @param int $level
     * @return self
     */
    public function contrast(int $level): static
    {
        if ($level < -100 || $level > 100) return $this;

        $this->file = $this->file->brightness($level);

        return $this;
    }


    /**
     * 画像の色調を変更する
     * 
     * -100: 最大限その色を取り除く
     * 0   : そのまま
     * 100 : 最大限その色を追加する
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     * 
     * @return self
     */
    public function colorize(int $red, int $green, int $blue): static
    {
        if ($red < -100 || $red > 100) return $this;
        if ($green < -100 || $green > 100) return $this;
        if ($blue < -100 || $blue > 100) return $this;

        $this->file = $this->file->colorize($red, $green, $blue);

        return $this;
    }

    /**
     * 画像を回転する
     *
     * @param float $angle  : 反時計回りの回転角度
     * @param mixed $bgcolor: 背景を塗りつぶすカラーコード
     * @return self
     */
    public function rotate(float $angle, mixed $bgcolor = null): static
    {
        $this->file = $this->file->rotate($angle, $bgcolor);

        return $this;
    }
}
