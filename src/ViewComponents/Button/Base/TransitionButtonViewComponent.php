<?php

namespace MyCustom\ViewComponents\Button\Base;

use MyCustom\ViewComponents\Button\Base\BaseButtonViewComponent;

abstract class TransitionButtonViewComponent extends BaseButtonViewComponent
{
    public string $url;

    function __construct(
        string $url,
        string $addClass = "",
        string $buttonText = "",
        string $buttonIcon = "",
    ) {
        $this->url = $url;

        parent::__construct($addClass, $buttonIcon, $buttonText);
    }
}
