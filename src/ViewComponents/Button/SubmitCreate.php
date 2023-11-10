<?php

namespace MyCustom\ViewComponents\Button;

use MyCustom\ViewComponents\Button\Base\SubmitButtonViewComponent;

class SubmitCreate extends SubmitButtonViewComponent
{
    protected function defaultButtonText(): string
    {
        return ___("mycustom.word.create");
    }
}
