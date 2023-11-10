<?php

namespace MyCustom\ViewComponents\Form;

use MyCustom\ViewComponents\Form\Base\BaseFormViewComponent;

class InputFile extends BaseFormViewComponent
{
    public string $name;

    public string $type;

    public bool $isMultiple;

    function __construct(
        string $name,
        string $type,
        bool $isMultiple = false
    ) {
        $this->name       = $name;
        $this->type       = $type;
        $this->isMultiple = $isMultiple;
    }
}
