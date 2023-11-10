<?php

namespace MyCustom\ViewComponents\Button;

use MyCustom\ViewComponents\Button\Base\TransitionButtonViewComponent;

class Link extends TransitionButtonViewComponent
{
    protected function defaultButtonText(): string
    {
        return ___("mycustom.word.link");
    }
}
