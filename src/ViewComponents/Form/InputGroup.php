<?php

namespace MyCustom\ViewComponents\Form;

use MyCustom\ViewComponents\Form\Base\BaseFormViewComponent;

class InputGroup extends BaseFormViewComponent
{
    public string $name;

    function __construct(
        string $name,
    ) {
        $this->name = $name;
    }
}
