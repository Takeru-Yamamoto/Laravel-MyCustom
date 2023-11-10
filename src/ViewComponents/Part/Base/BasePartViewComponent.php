<?php

namespace MyCustom\ViewComponents\Part\Base;

use MyCustom\ViewComponents\Base\BaseViewComponent;

abstract class BasePartViewComponent extends BaseViewComponent
{
    public function getComponentName(): string
    {
        return "part." . parent::getComponentName();
    }
}
