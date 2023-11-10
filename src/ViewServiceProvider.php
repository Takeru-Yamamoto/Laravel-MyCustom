<?php

namespace MyCustom;

use Illuminate\Support\ServiceProvider as Provider;

use Illuminate\Support\Facades\Blade;

use Illuminate\Pagination\Paginator;

use Illuminate\Support\Arr;

class ViewServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->loadViews();
        $this->addViewPaths();
        $this->registerViewComponents();
        $this->setPaginatorConfig();
    }


    /**
     * Viewを登録する
     */
    private function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . "views", "mycustom");
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
     * Viewを登録する
     */
    private function registerViewComponents(): void
    {
        Blade::componentNamespace("MyCustom\\ViewComponents", "mycustom");
    }

    /**
     * Paginatorの設定を行う
     */
    private function setPaginatorConfig(): void
    {
        Paginator::useBootstrap();
    }
}
