<?php

namespace MyCustom;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use MyCustom\Http\Gates\UserGate;
use MyCustom\Http\Gates\ApiGate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerPolicies();

        if (config("mycustom.default_gate")) {
            if (pathPrefix() === "api") {
                ApiGate::define();
            } else {
                UserGate::define();
            }
        }
    }
}
