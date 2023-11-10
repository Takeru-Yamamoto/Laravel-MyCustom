<?php

namespace MyCustom\ViewComponents\Common;

use MyCustom\ViewComponents\Common\Base\BaseCommonViewComponent;

class Tooltip extends BaseCommonViewComponent
{
    public string $tooltipTitle;
    public string $tooltipOption;

    function __construct(
        string $tooltipTitle,
        string $tooltipOption = "",
    ) {
        $this->tooltipTitle  = $tooltipTitle;
        $this->tooltipOption = $tooltipOption;
    }
}
