<?php

namespace MyCustom\Utils\Facades\Managers;

use MyCustom\Utils\Paginate\PaginateUtil;

use Illuminate\Pagination\LengthAwarePaginator;

use MyCustom\Http\Forms\PaginationForm;

class PaginateUtilManager
{
    public function make(): PaginateUtil
    {
        return new PaginateUtil();
    }


    public function generate(int $page, array $pageItems, int $pageItemLimit, int $totalItemCount, array $options = []): LengthAwarePaginator
    {
        return $this->make()
            ->setPage($page)
            ->setPageItems($pageItems)
            ->setPageItemLimit($pageItemLimit)
            ->setTotalItemCount($totalItemCount)
            ->setOptions($options)
            ->paginator();
    }

    public function fromForm(PaginationForm $paginationForm, array $pageItems, int $totalItemCount, array $options = []): LengthAwarePaginator
    {
        return $this->generate(
            $paginationForm->page,
            $pageItems,
            $paginationForm->pageItemLimit,
            $totalItemCount,
            $options
        );
    }
}
