<?php

namespace MyCustom;

use Illuminate\Support\ServiceProvider as Provider;

use Illuminate\Contracts\Http\Kernel;
use MyCustom\Http\Middleware\AccessAnalysisMiddleware;

class MiddlewareServiceProvider extends Provider
{
    public function boot(): void
    {
        $kernel = app(Kernel::class);
        $kernel->pushMiddleware(AccessAnalysisMiddleware::class);
    }

    public function register(): void
    {
        $this->app->singleton(AccessAnalysisMiddleware::class);
    }
}
