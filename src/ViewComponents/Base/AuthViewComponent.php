<?php

namespace MyCustom\ViewComponents\Base;

use MyCustom\ViewComponents\Base\BaseViewComponent;

abstract class AuthViewComponent extends BaseViewComponent
{
    public string $bodyClass = "login-page";
}
