<?php

namespace MyCustom;

use Illuminate\Support\ServiceProvider as Provider;

use Illuminate\Contracts\Debug\ExceptionHandler;
use MyCustom\Exceptions\Handler;

class ExceptionServiceProvider extends Provider
{
    public function register(): void
    {
        if (config("mycustom.custom_handler")) {
            $this->app->singleton(
                ExceptionHandler::class,
                Handler::class
            );
        }
    }
}
