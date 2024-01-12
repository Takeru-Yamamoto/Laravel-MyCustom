<?php

use Illuminate\Support\Str;

if (!function_exists("toKebab")) {

    /**
     * text をケバブケースに変換する
     *
     * @param string $text
     */
    function toKebab(string $text): string
    {
        return Str::kebab($text);
    }
}


if (!function_exists("toSnake")) {

    /**
     * text をスネークケースに変換する
     *
     * @param string $text
     */
    function toSnake(string $text): string
    {
        return Str::snake($text);
    }
}


if (!function_exists("toCamel")) {

    /**
     * text をキャメルケースに変換する
     *
     * @param string $text
     */
    function toCamel(string $text): string
    {
        return Str::camel($text);
    }
}


if (!function_exists("toPascal")) {

    /**
     * text をパスカルケース(アッパーキャメルケース)に変換する
     *
     * @param string $text
     */
    function toPascal(string $text): string
    {
        return Str::studly($text);
    }
}


if (!function_exists("toPlural")) {

    /**
     * text を複数形に変換する
     *
     * @param string $text
     */
    function toPlural(string $text): string
    {
        return Str::plural($text);
    }
}


if (!function_exists("toSingular")) {

    /**
     * text を単数形に変換する
     *
     * @param string $text
     */
    function toSingular(string $text): string
    {
        return Str::singular($text);
    }
}


if (!function_exists("toSlug")) {

    /**
     * text をURLフレンドリーなスラッグに変換する
     *
     * @param string $text
     */
    function toSlug(string $text): string
    {
        return Str::slug($text);
    }
}


if (!function_exists("toAscii")) {

    /**
     * text を最も近い ASCII 表現に変換する
     *
     * @param string $text
     * @param string $unknown
     * @param bool $strict
     */
    function toAscii(string $text, string $unknown = "?", bool $strict = false): string
    {
        return Str::transliterate($text, $unknown, $strict);
    }
}
