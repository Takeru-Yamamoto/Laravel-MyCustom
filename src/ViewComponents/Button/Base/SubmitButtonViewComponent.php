<?php

namespace MyCustom\ViewComponents\Button\Base;

use MyCustom\ViewComponents\Button\Base\BaseButtonViewComponent;

abstract class SubmitButtonViewComponent extends BaseButtonViewComponent
{
    public string $formId;

    function __construct(
        string $formId,
        string $addClass = "",
        string $buttonText = "",
        string $buttonIcon = "",
    ) {
        $this->formId = $formId;

        parent::__construct($addClass, $buttonIcon, $buttonText);
    }
}
