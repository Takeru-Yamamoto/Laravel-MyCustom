<?php

namespace MyCustom\ViewComponents\Common;

use MyCustom\ViewComponents\Common\Base\BaseCommonViewComponent;

class AccordionItem extends BaseCommonViewComponent
{
    public string $accordionType;
    public string $accordionTitle;

    function __construct(
        string $accordionType,
        string $accordionTitle,
    ) {
        $this->accordionType  = $accordionType;
        $this->accordionTitle = $accordionTitle;
    }
}
