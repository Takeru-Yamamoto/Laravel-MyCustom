<?php

namespace MyCustom\ViewComponents\Form\Base;

use MyCustom\ViewComponents\Base\BaseViewComponent;

abstract class BaseFormViewComponent extends BaseViewComponent
{
    public function getComponentName(): string
    {
        return "form." . parent::getComponentName();
    }
}
