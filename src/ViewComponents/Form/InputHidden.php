<?php

namespace MyCustom\ViewComponents\Form;

use MyCustom\ViewComponents\Form\Base\BaseFormViewComponent;

class InputHidden extends BaseFormViewComponent
{
    public string $name;

    public string $type;

    public mixed $value;

    function __construct(
        string $name,
        string $type,
        mixed $value,
    ) {
        $this->name  = $name;
        $this->type  = $type;
        $this->value = $value;
    }
}
