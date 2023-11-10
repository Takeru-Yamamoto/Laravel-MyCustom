<?php

namespace MyCustom\Utils\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \MyCustom\Utils\Text\TextUtil make(string $textKey, array $replaces = [])
 * 
 * @method static string text(string $textKey, array $replaces = [])
 * @method static string createdText(string $textKey, array $replaces = [])
 * @method static string updatedText(string $textKey, array $replaces = [])
 * @method static string deletedText(string $textKey, array $replaces = [])
 * @method static string succeededText(string $textKey, array $replaces = [])
 * @method static string failedText(string $textKey, array $replaces = [])
 * @method static string createSucceededText(string $textKey, array $replaces = [])
 * @method static string createFailedText(string $textKey, array $replaces = [])
 * @method static string updateSucceededText(string $textKey, array $replaces = [])
 * @method static string updateFailedText(string $textKey, array $replaces = [])
 * @method static string deletedSucceededText(string $textKey, array $replaces = [])
 * @method static string deletedFailedText(string $textKey, array $replaces = [])
 * 
 * @see \MyCustom\Utils\Facades\Managers\TextUtilManager
 */
class Text extends Facade
{
    /** 
     * Get the registered name of the component. 
     * 
     * @return string 
     */
    protected static function getFacadeAccessor()
    {
        return "TextUtil";
    }
}
