<?php

namespace MyCustom\ViewComponents\Form;

use MyCustom\ViewComponents\Form\Base\BaseFormViewComponent;

class Select extends BaseFormViewComponent
{
    public string $name;

    public string $addClass;

    function __construct(
        string $name,
        string $addClass = '',
    ) {
        $this->name     = $name;
        $this->addClass = $addClass;
    }
}
