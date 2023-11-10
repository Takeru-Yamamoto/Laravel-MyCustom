<?php

namespace MyCustom\Utils\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \MyCustom\Utils\Paginate\PaginateUtil make()
 * 
 * @method static \Illuminate\Pagination\LengthAwarePaginator generate(int $page, array $pageItems, int $pageItemLimit, int $totalItemCount, array $options = [])
 * @method static \Illuminate\Pagination\LengthAwarePaginator fromForm(\MyCustom\Http\Forms\PaginationForm $paginationForm, array $pageItems, int $totalItemCount, array $options = [])
 * 
 * 
 * @see \MyCustom\Utils\Facades\Managers\PaginateUtilManager
 */
class Paginate extends Facade
{
    /** 
     * Get the registered name of the component. 
     * 
     * @return string 
     */
    protected static function getFacadeAccessor()
    {
        return "PaginateUtil";
    }
}
