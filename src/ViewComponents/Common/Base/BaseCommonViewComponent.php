<?php

namespace MyCustom\ViewComponents\Common\Base;

use MyCustom\ViewComponents\Base\BaseViewComponent;

abstract class BaseCommonViewComponent extends BaseViewComponent
{
    public function getComponentName(): string
    {
        return "common." . parent::getComponentName();
    }
}
