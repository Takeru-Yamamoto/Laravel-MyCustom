<?php

namespace MyCustom\ViewComponents\Part\Sidebar;

use MyCustom\ViewComponents\Part\Sidebar\Base\BaseSidebarPartViewComponent;

class Link extends BaseSidebarPartViewComponent
{
    public string $navLinkClass;
    public string $navLinkHref;
    public string $navLinkIcon;
    public string $navLinkIconClass;
    public string $navLinkTitle;
    public string $navLinkTitleClass;

    function __construct(array $page)
    {
        parent::__construct($page);

        $this->navLinkClass = isset($this->page["class"]) ? $this->page["class"] : "";

        $issetHref   = isset($this->page["href"]);
        $issetRoute  = isset($this->page["route"]);
        $issetParams = isset($this->page["params"]);

        $this->navLinkHref = match (true) {
            $issetHref                  => $this->page["href"],
            $issetRoute && $issetParams => route($this->page["route"], $this->page["params"]),
            $issetRoute                 => route($this->page["route"]),
            default                     => "#",
        };

        $this->navLinkIconClass = isset($this->page["icon_class"]) ? $this->page["icon_class"] : "";
        $this->navLinkIcon      = isset($this->page["icon"]) ? $this->page["icon"] : "";

        $this->navLinkTitleClass = isset($this->page["title_class"]) ? $this->page["title_class"] : "";
        $this->navLinkTitle      = isset($this->page["title"]) ? ___($this->page["title"]) : "";
    }
}
