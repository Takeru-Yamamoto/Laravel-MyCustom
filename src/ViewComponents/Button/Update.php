<?php

namespace MyCustom\ViewComponents\Button;

use MyCustom\ViewComponents\Button\Base\TransitionButtonViewComponent;

class Update extends TransitionButtonViewComponent
{
    protected function defaultButtonText(): string
    {
        return ___("mycustom.word.update");
    }
}
