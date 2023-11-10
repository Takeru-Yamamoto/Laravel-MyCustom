<?php

namespace MyCustom;

use Illuminate\Support\ServiceProvider as Provider;

use Illuminate\Support\Facades\URL;

use Illuminate\Support\Str;

class UrlServiceProvider extends Provider
{
    public function boot(): void
    {
        if (config("mycustom.force_url")) {
            URL::forceScheme(Str::startsWith(config("app.url"), "https") ? "https" : "http");
            URL::forceRootUrl(config("app.url"));
        }
    }
}
