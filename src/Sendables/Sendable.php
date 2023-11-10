<?php

namespace MyCustom\Sendables;

interface Sendable
{
    /**
     * 送信する
     *
     * @return bool
     */
    public function sending(): bool;
}
