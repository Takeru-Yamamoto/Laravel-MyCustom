<?php

namespace MyCustom\ViewComponents\Base;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Illuminate\Support\Facades\View as ViewFacade;

abstract class BaseViewComponent extends Component
{
    public string $bodyClass = "sidebar-mini";

    final public function render(): View|\Closure|string
    {
        return view("mycustom::" . $this->getComponentName());
    }

    public function getComponentName(): string
    {
        return toKebab(className($this));
    }


    /* property function common */
    final public function myCustomSiteName(): string
    {
        return config("mycustom.site_name");
    }

    final public function myCustomMetaDescription(): string
    {
        return config("mycustom.meta_description");
    }

    final public function myCustomPages(): array
    {
        return config("mycustom.pages");
    }

    final public function myCustomDefaultPrefix(): string
    {
        return config("mycustom.default_prefix");
    }

    final public function myCustomPageTitle(): string
    {
        $pages = $this->myCustomPages();
        $prefix = pathPrefix($this->myCustomDefaultPrefix());
        $siteName = $this->myCustomSiteName();

        return isset($pages[$prefix]) && isset($pages[$prefix]["title"]) ? ___($pages[$prefix]["title"]) . " | " . $siteName : $siteName;
    }


    /* property function icon */
    final public function myCustomIconPath(): string
    {
        return config("mycustom.view_icon") ? asset(config("mycustom.icon_path")) : "";
    }

    final public function myCustomFaviconPath(): string
    {
        return empty(config("mycustom.favicon_path")) ? "" : asset(config("mycustom.favicon_path"));
    }


    /* view function */
    final public function hasSection(string $sectionName): string
    {
        return ViewFacade::hasSection($sectionName);
    }
}
