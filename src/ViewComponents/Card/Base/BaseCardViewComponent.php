<?php

namespace MyCustom\ViewComponents\Card\Base;

use MyCustom\ViewComponents\Base\BaseViewComponent;

abstract class BaseCardViewComponent extends BaseViewComponent
{
    public function getComponentName(): string
    {
        return "card." . parent::getComponentName();
    }
}
