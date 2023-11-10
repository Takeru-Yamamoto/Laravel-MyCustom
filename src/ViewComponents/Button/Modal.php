<?php

namespace MyCustom\ViewComponents\Button;

use MyCustom\ViewComponents\Button\Base\BaseButtonViewComponent;

class Modal extends BaseButtonViewComponent
{
    public string $modalId;

    function __construct(
        string $modalId,
        string $addClass = "",
        string $buttonIcon = "",
        string $buttonText = "",
    ) {
        $this->modalId = $modalId;

        parent::__construct($addClass, $buttonIcon, $buttonText);
    }

    protected function defaultButtonText(): string
    {
        return ___("mycustom.word.show_modal");
    }
}
