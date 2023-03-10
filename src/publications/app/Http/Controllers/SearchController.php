<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
use App\Http\Forms\Search as Forms;
use App\Services\SearchService;

class SearchController extends BaseController
{
    private SearchService $service;

    function __construct()
    {
        $this->service = new SearchService;
    }

    public function search(Request $request): array|null
    {
        return $this->service->search(new Forms\SearchForm($request->all()));
    }
}
