<?php

namespace MyCustom\ViewComponents\Part\Sidebar;

use MyCustom\ViewComponents\Part\Sidebar\Base\BaseSidebarPartViewComponent;

class Tree extends BaseSidebarPartViewComponent
{
    public string $navLinkClass;
    public string $navLinkIcon;
    public string $navLinkIconClass;
    public string $navLinkTitle;
    public string $navLinkTitleClass;

    public array $children;

    function __construct(array $page)
    {
        parent::__construct($page);

        $this->navLinkClass = isset($this->page["class"]) ? $this->page["class"] : "";

        $this->navLinkIconClass = isset($this->page["icon_class"]) ? $this->page["icon_class"] : "";
        $this->navLinkIcon      = isset($this->page["icon"]) ? $this->page["icon"] : "";

        $this->navLinkTitleClass = isset($this->page["title_class"]) ? $this->page["title_class"] : "";
        $this->navLinkTitle      = isset($this->page["title"]) ? ___($this->page["title"]) : "";

        $this->children = isset($this->page["children"]) ? $this->page["children"] : [];
    }
}
