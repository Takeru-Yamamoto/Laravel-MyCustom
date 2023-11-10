<?php

namespace MyCustom\ViewComponents\Common;

use MyCustom\ViewComponents\Common\Base\BaseCommonViewComponent;

class Modal extends BaseCommonViewComponent
{
    public string $modalId;

    public string $modalTitle;
    public string $modalBody;
    public string $modalFooter;

    public array $data;
    public bool $isStatic;

    function __construct(
        string $modalId,
        string $modalTitle,
        string $modalBody,
        string $modalFooter,
        array $data = [],
        bool $isStatic = false,
    ) {
        $this->modalId = $modalId;

        $this->modalTitle  = $modalTitle;
        $this->modalBody   = $modalBody;
        $this->modalFooter = $modalFooter;

        $this->data     = $data;
        $this->isStatic = $isStatic;
    }
}
