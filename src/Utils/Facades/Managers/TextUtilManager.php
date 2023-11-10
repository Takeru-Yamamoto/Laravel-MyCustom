<?php

namespace MyCustom\Utils\Facades\Managers;

use MyCustom\Utils\Text\TextUtil;

class TextUtilManager
{
    public function make(string $textKey, array $replaces = []): TextUtil
    {
        return new TextUtil($textKey, $replaces);
    }

    public function text(string $textKey, array $replaces = []): string
    {
        return $this->make($textKey, $replaces)->text();
    }

    public function createdText(string $textKey, array $replaces = []): string
    {
        return $this->make($textKey, $replaces)->createdText();
    }

    public function updatedText(string $textKey, array $replaces = []): string
    {
        return $this->make($textKey, $replaces)->updatedText();
    }

    public function deletedText(string $textKey, array $replaces = []): string
    {
        return $this->make($textKey, $replaces)->deletedText();
    }
    
    public function succeededText(string $textKey, array $replaces = []): string
    {
        return $this->make($textKey, $replaces)->succeededText();
    }

    public function failedText(string $textKey, array $replaces = []): string
    {
        return $this->make($textKey, $replaces)->failedText();
    }

    public function createSucceededText(string $textKey, array $replaces = []): string
    {
        return $this->make($textKey, $replaces)->createSucceededText();
    }

    public function createFailedText(string $textKey, array $replaces = []): string
    {
        return $this->make($textKey, $replaces)->createFailedText();
    }

    public function updateSucceededText(string $textKey, array $replaces = []): string
    {
        return $this->make($textKey, $replaces)->updateSucceededText();
    }

    public function updateFailedText(string $textKey, array $replaces = []): string
    {
        return $this->make($textKey, $replaces)->updateFailedText();
    }

    public function deleteSucceededText(string $textKey, array $replaces = []): string
    {
        return $this->make($textKey, $replaces)->deleteSucceededText();
    }

    public function deleteFailedText(string $textKey, array $replaces = []): string
    {
        return $this->make($textKey, $replaces)->deleteFailedText();
    }
}
