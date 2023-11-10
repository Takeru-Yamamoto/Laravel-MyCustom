<?php

namespace MyCustom\ViewComponents\Form;

use MyCustom\ViewComponents\Form\Base\BaseFormViewComponent;

class RadioButton extends BaseFormViewComponent
{
    public string $name;

    public mixed $value;

    public bool $isChecked;

    function __construct(
        string $name,
        mixed $value = null,
        bool $isChecked = false,
    ) {
        $this->name      = $name;
        $this->value     = $value;
        $this->isChecked = $isChecked;
    }
}
