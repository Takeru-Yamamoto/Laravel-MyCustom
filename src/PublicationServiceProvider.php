<?php

namespace MyCustom;

use Illuminate\Support\ServiceProvider as Provider;

class PublicationServiceProvider extends Provider
{
    /**
     * publications配下をpublishする際に使うルートパス
     *
     * @var string
     */
    private string $publicationsPath = __DIR__ . "/publications";


    public function boot(): void
    {
        $this->publishApp();
        $this->publishConfig();
        $this->publishDatabase();
        $this->publishLang();
        $this->publishResources();
        $this->publishRoutes();
    }


    /**
     * appディレクトリ配下に公開する
     */
    private function publishApp()
    {
        // 共通タグ
        $this->publishes([
            $this->publicationsPath . "/app"                  => app_path(),
        ], "mycustom");

        // app配下のみ
        $this->publishes([
            $this->publicationsPath . "/app"                  => app_path(),
        ], "mycustom-app");

        // Http配下
        $this->publishes([
            $this->publicationsPath . "/app/Http"             => app_path("Http"),
        ], "mycustom-http");

        // Controllers配下
        $this->publishes([
            $this->publicationsPath . "/app/Http/Controllers" => app_path("Http/Controllers"),
        ], "mycustom-controllers");

        // Forms配下
        $this->publishes([
            $this->publicationsPath . "/app/Http/Forms"       => app_path("Http/Forms"),
        ], "mycustom-forms");

        // Models配下
        $this->publishes([
            $this->publicationsPath . "/app/Models"           => app_path("Models"),
        ], "mycustom-models");

        // Repositories配下
        $this->publishes([
            $this->publicationsPath . "/app/Repositories"     => app_path("Repositories"),
        ], "mycustom-repositories");

        // Services配下
        $this->publishes([
            $this->publicationsPath . "/app/Services"         => app_path("Services"),
        ], "mycustom-services");
    }


    /**
     * configディレクトリ配下に公開する
     */
    private function publishConfig()
    {
        // 共通タグ
        $this->publishes([
            $this->publicationsPath . "/config" => config_path(),
        ], "mycustom");

        // config配下のみ
        $this->publishes([
            $this->publicationsPath . "/config" => config_path(),
        ], "mycustom-config");
    }


    /**
     * databaseディレクトリ配下に公開する
     */
    private function publishDatabase()
    {
        // 共通タグ
        $this->publishes([
            $this->publicationsPath . "/database" => database_path(),
        ], "mycustom");

        // database配下のみ
        $this->publishes([
            $this->publicationsPath . "/database" => database_path(),
        ], "mycustom-database");
    }


    /**
     * langディレクトリ配下に公開する
     */
    private function publishLang()
    {
        // 共通タグ
        $this->publishes([
            $this->publicationsPath . "/lang" => lang_path(),
        ], "mycustom");

        // lang配下のみ
        $this->publishes([
            $this->publicationsPath . "/lang" => lang_path(),
        ], "mycustom-lang");
    }


    /**
     * resourcesディレクトリ配下に公開する
     */
    private function publishResources()
    {
        // 共通タグ
        $this->publishes([
            $this->publicationsPath . "/resources" => resource_path(),
        ], "mycustom");

        // resources配下のみ
        $this->publishes([
            $this->publicationsPath . "/resources" => resource_path(),
        ], "mycustom-resources");
    }


    /**
     * routesディレクトリ配下に公開する
     */
    private function publishRoutes()
    {
        // 共通タグ
        $this->publishes([
            $this->publicationsPath . "/routes" => base_path("routes"),
        ], "mycustom");

        // routes配下のみ
        $this->publishes([
            $this->publicationsPath . "/routes" => base_path("routes"),
        ], "mycustom-routes");
    }
}
