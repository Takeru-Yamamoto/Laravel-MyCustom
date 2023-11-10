<?php

namespace MyCustom\Utils\Facades\Managers;

use MyCustom\Utils\Redirect\RedirectUtil;

class RedirectUtilManager
{
    public function make(string $url): RedirectUtil
    {
        return new RedirectUtil($url);
    }

    public function previous(): RedirectUtil
    {
        return $this->make(url()->previous());
    }

    public function route(string $route, array $parameters = [], bool $absolute = true): RedirectUtil
    {
        return $this->make(route($route, $parameters, $absolute));
    }
}
