<?php

namespace MyCustom\ViewComponents\Button;

use MyCustom\ViewComponents\Button\Base\TransitionButtonViewComponent;

class Search extends TransitionButtonViewComponent
{
    protected function defaultButtonText(): string
    {
        return ___("mycustom.word.search");
    }
}
