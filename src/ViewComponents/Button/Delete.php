<?php

namespace MyCustom\ViewComponents\Button;

use MyCustom\ViewComponents\Button\Base\BaseButtonViewComponent;

class Delete extends BaseButtonViewComponent
{
    public int $id;

    public string $url;

    function __construct(
        int $id,
        string $url,
        string $addClass = "",
        string $buttonIcon = "",
        string $buttonText = "",
    ) {
        $this->id  = $id;
        $this->url = $url;

        parent::__construct($addClass, $buttonIcon, $buttonText);
    }

    protected function defaultButtonText(): string
    {
        return ___("mycustom.word.delete");
    }
}
