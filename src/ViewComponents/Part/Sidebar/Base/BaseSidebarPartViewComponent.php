<?php

namespace MyCustom\ViewComponents\Part\Sidebar\Base;

use MyCustom\ViewComponents\Part\Base\BasePartViewComponent;

abstract class BaseSidebarPartViewComponent extends BasePartViewComponent
{
    public array $page;

    function __construct(array $page)
    {
        $this->page = $page;
    }

    public function getComponentName(): string
    {
        return str_replace("part.", "part.sidebar.", parent::getComponentName());
    }
}
