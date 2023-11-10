<?php

namespace MyCustom\ViewComponents\Part\Sidebar;

use MyCustom\ViewComponents\Part\Sidebar\Base\BaseSidebarPartViewComponent;

class Item extends BaseSidebarPartViewComponent
{
    /* view function sidebar item */
    final public function isUserCan(): bool
    {
        return !isset($this->page["can"]) || (isLoggedIn() && userCan($this->page["can"]));
    }

    final public function hasChildren(): bool
    {
        return isset($this->page["children"]);
    }
}
