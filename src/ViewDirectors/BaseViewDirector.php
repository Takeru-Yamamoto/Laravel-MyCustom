<?php

namespace MyCustom\ViewDirectors;

use Illuminate\Contracts\View\View;

abstract class BaseViewDirector
{
    /**
     * Bladeファイルのパス
     *
     * @var string
     */
    protected string $bladePath;

    /**
     * 出力するHTMLファイルのパス
     *
     * @var string
     */
    protected string $outputPath;

    /**
     * 出力するHTMLファイルのディレクトリを作成するかどうかのフラグ
     *
     * @var bool
     */
    protected bool $isCreateOutputDirectory = true;


    /**
     * HTMLとして出力することができたかどうかのフラグ
     *
     * @var bool
     */
    private bool $isGenerated = false;

    /**
     * bladePath の置換に用いる連想配列
     *
     * @var array
     */
    private array $replaceBladePathCombinations = [];

    /**
     * outputPath の置換に用いる連想配列
     *
     * @var array
     */
    private array $replaceOutputPathCombinations = [];

    /**
     * HTMLとして出力するBladeファイルで使用する変数名と値の連想配列
     *
     * @var array
     */
    private array $bladeProperties = [];



    final public function generate(): bool
    {
        if ($this->isCreateOutputDirectory) $this->makeOutputDirectory();

        $this->isGenerated = file_put_contents($this->outputPath(), $this->viewRender()) !== false;

        return $this->isGenerated;
    }

    /**
     * Viewオブジェクトを生成する
     *
     * @return View
     */
    final public function view(): View
    {
        return view($this->bladePath(), array_merge($this->defaultBladeProperty(), $this->bladeProperties));
    }

    /**
     * Viewをレンダリングした文字列を取得する
     *
     * @return string
     */
    final public function viewRender(): string
    {
        return $this->view()->render();
    }


    /**
     * HTMLとして出力出来たかどうか
     *
     * @return bool
     */
    final public function isGenerated(): bool
    {
        return $this->isGenerated;
    }

    /**
     * bladeファイルで使用するプロパティを設定する
     *
     * @param array $bladeProperties
     * @return static
     */
    final public function setBladeProperties(array $bladeProperties): static
    {
        $this->bladeProperties = $bladeProperties;

        return $this;
    }

    /**
     * bladeファイルで使用するプロパティを追加する
     *
     * @param string|int $key
     * @param mixed $value
     * @return static
     */
    final public function addBladeProperty(string|int $key, mixed $value): static
    {
        $this->bladeProperties[$key] = $value;

        return $this;
    }

    /**
     * bladeファイルで使用するデフォルトのプロパティを取得する
     *
     * @return array
     */
    protected function defaultBladeProperty(): array
    {
        return [];
    }



    /**
     * 使用するBladeファイルのパスを取得する
     *
     * @return string
     */
    final protected function bladePath(): string
    {
        if (empty($this->replaceBladePathCombinations)) return $this->bladePath;

        return str_replace(
            array_keys($this->replaceBladePathCombinations),
            array_values($this->replaceBladePathCombinations),
            $this->bladePath
        );
    }

    /**
     * 使用するBladeファイルのパスを置き換える組み合わせを設定する
     *
     * @param array $replaceBladePathCombinations
     * @return static
     */
    final public function setReplaceBladePath(array $replaceBladePathCombinations): static
    {
        $this->replaceBladePathCombinations = $replaceBladePathCombinations;

        return $this;
    }

    /**
     * 使用するBladeファイルのパスを置き換える組み合わせを追加する
     *
     * @param string|int $key
     * @param mixed $value
     * @return static
     */
    final public function addReplaceBladePath(string|int $key, mixed $value): static
    {
        $this->replaceBladePathCombinations[$key] = $value;

        return $this;
    }


    /**
     * 出力するHTMLファイルのパスを取得する
     *
     * @return string
     */
    final protected function outputPath(): string
    {
        if (empty($this->replaceOutputPathCombinations)) return $this->outputPath;

        return str_replace(
            array_keys($this->replaceOutputPathCombinations),
            array_values($this->replaceOutputPathCombinations),
            $this->outputPath
        );
    }

    /**
     * 出力するHTMLファイルのパスを置き換える組み合わせを設定する
     *
     * @param array $replaceOutputPathCombinations
     * @return static
     */
    final public function setReplaceOutputPath(array $replaceOutputPathCombinations): static
    {
        $this->replaceOutputPathCombinations = $replaceOutputPathCombinations;

        return $this;
    }

    /**
     * 出力するHTMLファイルのパスを置き換える組み合わせを追加する
     *
     * @param string|int $key
     * @param mixed $value
     * @return static
     */
    final public function addReplaceOutputPath(string|int $key, mixed $value): static
    {
        $this->replaceOutputPathCombinations[$key] = $value;

        return $this;
    }


    /**
     * 出力するHTMLファイルのディレクトリを再帰的に作成する
     *
     * @return void
     */
    private function makeOutputDirectory(): void
    {
        $outputDirectory = dirname($this->outputPath());

        if (!file_exists($outputDirectory)) mkdir($outputDirectory, 0775, true);
    }
}
