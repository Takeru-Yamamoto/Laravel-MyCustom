<?php

namespace MyCustom;

use Illuminate\Support\ServiceProvider as Provider;

use Illuminate\Contracts\Http\Kernel;

use MyCustom\Http\Middleware\AccessAnalysisMiddleware;

class ServiceProvider extends Provider
{
    public function boot(): void
    {
        $this->pushMiddleware();
    }


    /**
     * middlewareをKernelに追加する
     */
    private function pushMiddleware(): void
    {
        $kernel = app(Kernel::class);
        $kernel->pushMiddleware(AccessAnalysisMiddleware::class);
    }
}
