<?php

namespace MyCustom;

use Illuminate\Support\ServiceProvider as Provider;

use MyCustom\Utils\Facades\Managers\DateUtilManager;
use MyCustom\Utils\Facades\Managers\FileUtilManager;
use MyCustom\Utils\Facades\Managers\HttpUtilManager;
use MyCustom\Utils\Facades\Managers\TimeUtilManager;
use MyCustom\Utils\Facades\Managers\RedirectUtilManager;
use MyCustom\Utils\Facades\Managers\LoggingUtilManager;
use MyCustom\Utils\Facades\Managers\CryptUtilManager;
use MyCustom\Utils\Facades\Managers\CalculateUtilManager;
use MyCustom\Utils\Facades\Managers\PaginateUtilManager;
use MyCustom\Utils\Facades\Managers\TextUtilManager;

class FacadeServiceProvider extends Provider
{
    public function register(): void
    {
        $this->app->singleton("DateUtil", function () {
            return new DateUtilManager();
        });

        $this->app->singleton("FileUtil", function () {
            return new FileUtilManager();
        });

        $this->app->singleton("HttpUtil", function () {
            return new HttpUtilManager();
        });

        $this->app->singleton("TimeUtil", function () {
            return new TimeUtilManager();
        });

        $this->app->singleton("RedirectUtil", function () {
            return new RedirectUtilManager();
        });

        $this->app->singleton("LoggingUtil", function () {
            return new LoggingUtilManager();
        });

        $this->app->singleton("CryptUtil", function () {
            return new CryptUtilManager();
        });

        $this->app->singleton("CalculateUtil", function () {
            return new CalculateUtilManager();
        });

        $this->app->singleton("PaginateUtil", function () {
            return new PaginateUtilManager();
        });

        $this->app->singleton("TextUtil", function () {
            return new TextUtilManager();
        });
    }
}
