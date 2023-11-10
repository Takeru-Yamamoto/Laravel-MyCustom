<?php

namespace MyCustom\Utils\Paginate;

use MyCustom\Jsonables\BaseJsonable;

use Illuminate\Pagination\LengthAwarePaginator;

final class PaginateUtil extends BaseJsonable
{
    /**
     * ページネーターのページ数
     *
     * @var int
     */
    private int $page = 0;

    /**
     * ページネーターのページアイテム
     *
     * @var array
     */
    private array $pageItems = [];

    /**
     * 1ページあたりのアイテム数
     *
     * @var int
     */
    private int $pageItemLimit = 0;

    /**
     * アイテムの総数
     *
     * @var int
     */
    private int $totalItemCount = 0;

    /**
     * ページネーターのオプション
     *
     * @var array
     */
    private array $options = [];


    /**
     * LengthAwarePaginatorを取得する
     *
     * @return LengthAwarePaginator
     */
    public function paginator(): LengthAwarePaginator
    {
        return new LengthAwarePaginator($this->pageItems, $this->totalItemCount, $this->pageItemLimit, $this->page, $this->options);
    }

    /**
     * page setter
     * 
     * @param int $page
     * 
     * @return self
     */
    public function setPage(int $page): static
    {
        $this->page = $page;
        return $this;
    }

    /**
     * pageItems setter
     * 
     * @param array $pageItems
     * 
     * @return self
     */
    public function setPageItems(array $pageItems): static
    {
        $this->pageItems = $pageItems;
        return $this;
    }

    /**
     * pageItemLimit setter
     * 
     * @param int $pageItemLimit
     * 
     * @return self
     */
    public function setPageItemLimit(int $pageItemLimit): static
    {
        $this->pageItemLimit = $pageItemLimit;
        return $this;
    }

    /**
     * totalItemCount setter
     * 
     * @param int $totalItemCount
     * 
     * @return self
     */
    public function setTotalItemCount(int $totalItemCount): static
    {
        $this->totalItemCount = $totalItemCount;
        return $this;
    }

    /**
     * options setter
     * 
     * @param array $options
     * 
     * @return self
     */
    public function setOptions(array $options): static
    {
        $this->options = $options;

        // optionにpathがセットされていない場合はpathをセットする
        if (!isset($this->options["path"])) {
            $path = explode("/", request()->path());
            $this->options["path"] = end($path);
        }

        return $this;
    }
}
