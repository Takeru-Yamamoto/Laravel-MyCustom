<?php

namespace MyCustom;

use Illuminate\Support\ServiceProvider as Provider;

use Illuminate\Pagination\Paginator;

use Illuminate\Support\Arr;

class ViewServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->addViewPaths();
        $this->setPaginatorConfig();
    }

    /**
     * resources/views/pages 配下をコンフィグに追加する
     */
    private function addViewPaths()
    {
        $this->app["config"]["view.paths"] = Arr::add(
            $this->app["config"]["view.paths"],
            "pages",
            resource_path("views" . DIRECTORY_SEPARATOR . "pages")
        );
    }

    /**
     * Paginatorの設定を行う
     */
    private function setPaginatorConfig(): void
    {
        Paginator::useBootstrap();
    }
}
