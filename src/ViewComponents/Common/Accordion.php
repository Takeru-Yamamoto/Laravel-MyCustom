<?php

namespace MyCustom\ViewComponents\Common;

use MyCustom\ViewComponents\Common\Base\BaseCommonViewComponent;

class Accordion extends BaseCommonViewComponent
{
    public string $accordionId;

    function __construct(
        string $accordionId
    ) {
        $this->accordionId = $accordionId;
    }
}
