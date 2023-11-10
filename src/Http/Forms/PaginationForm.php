<?php

namespace MyCustom\Http\Forms;

use MyCustom\Http\Forms\BaseForm;

use Illuminate\Http\Request;


/**
 * ページネーションに使用するFormクラス
 * 
 * Paginatorを返すレスポンスを必要とするリクエストに使用する
 */
abstract class PaginationForm extends BaseForm
{
    /**
     * ページネーションに使用するページ番号
     *
     * @var int
     */
    public int $page;

    /**
     * ページネーションに使用するページ番号のデフォルト値
     * デフォルトは0
     *
     * @var int
     */
    public int $defaultPage = 1;

    /**
     * ページネーションに使用する1ページの表示件数
     * デフォルトは10
     *
     * @var int
     */
    public int $pageItemLimit = 10;

    function __construct(Request|array $input)
    {
        parent::__construct($input);

        $this->page = $this->inputInt("page", $this->defaultPage);
    }

    final protected function additionalRules(): array
    {
        return [
            "page" => $this->nullable($this->integer()),
        ];
    }

    final public function offset(): int
    {
        return ($this->page - 1) * $this->pageItemLimit;
    }

    final public function start(int $default = 0): int
    {
        return $this->offset() + $default;
    }

    final public function end(int $default = 0): int
    {
        return $this->offset() + $default + $this->pageItemLimit - 1;
    }
}
