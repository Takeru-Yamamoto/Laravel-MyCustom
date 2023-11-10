<?php

namespace MyCustom\ViewComponents\Button;

use MyCustom\ViewComponents\Button\Base\BaseButtonViewComponent;

class Flag extends BaseButtonViewComponent
{
    public int $id;
    public string $url;
    public bool $isValid;
    public string $buttonColor;

    function __construct(
        int $id,
        string $url,
        bool $isValid,
        string $addClass = "",
        string $buttonIcon = "",
    ) {
        $this->id          = $id;
        $this->url         = $url;
        $this->isValid     = $isValid;
        $this->buttonColor = $isValid ? "btn-light" : "btn-secondary";

        parent::__construct($addClass, $buttonIcon);
    }

    protected function defaultButtonText(): string
    {
        return $this->isValid ? ___("mycustom.word.true") : ___("mycustom.word.false");
    }
}
