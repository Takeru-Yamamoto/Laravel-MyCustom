<?php

namespace MyCustom\ViewComponents\Common;

use MyCustom\ViewComponents\Common\Base\BaseCommonViewComponent;

class Border extends BaseCommonViewComponent
{
    public int $margin;

    function __construct(int $margin = 3)
    {
        $this->margin = $margin;
    }
}
