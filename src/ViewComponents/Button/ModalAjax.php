<?php

namespace MyCustom\ViewComponents\Button;

use MyCustom\ViewComponents\Button\Base\BaseButtonViewComponent;

class ModalAjax extends BaseButtonViewComponent
{
    public int $id;
    public string $modalId;
    public string $url;
    public string $type;

    function __construct(
        int $id,
        string $modalId,
        string $url,
        string $type,
        string $addClass = "",
        string $buttonIcon = "",
        string $buttonText = "",
    ) {
        $this->id      = $id;
        $this->modalId = $modalId;
        $this->url     = $url;
        $this->type    = $type;

        parent::__construct($addClass, $buttonIcon, $buttonText);
    }

    protected function defaultButtonText(): string
    {
        return ___("mycustom.word.show_modal");
    }
}
