<?php

namespace MyCustom\ViewComponents\Form;

use MyCustom\ViewComponents\Form\Base\BaseFormViewComponent;

class SelectOption extends BaseFormViewComponent
{
    public mixed $value;

    public bool $isSelected;

    function __construct(
        mixed $value     = null,
        bool $isSelected = false,
    ) {
        $this->value      = $value;
        $this->isSelected = $isSelected;
    }
}
