<?php

use Illuminate\Support\Str;

if (!function_exists("enl2br")) {

    /**
     * HTMLタグのエスケープ処理 & 改行コードをbrタグに変更
     *
     * @param string $text
     */
    function enl2br(string $text): string
    {
        return str_replace(["\r\n", "\r", "\n"], "<br />", e($text));
    }
}


if (!function_exists("br2nl")) {

    /**
     * brタグを改行コードに変更
     *
     * @param string $text
     */
    function br2nl(string $text): string
    {
        return preg_replace("/\<br(\s*)?\/?\>/i", PHP_EOL, $text);
    }
}


if (!function_exists("randomText")) {

    /**
     * length の長さのランダムなテキストを取得する
     *
     * @param integer $length
     */
    function randomText(int $length = 16): string
    {
        return Str::random($length);
    }
}


if (!function_exists("randomNumber")) {

    /**
     * digit 桁のランダムな数字を取得する
     *
     * @param integer $digit
     */
    function randomNumber(int $digit = 16): string
    {
        return sprintf("%0" . $digit . "d", random_int(0, pow(10, $digit) - 1));
    }
}


if (!function_exists("removeFromEnd")) {

    /**
     * text の後ろから num 文字文取り除く
     *
     * @param string $text
     * @param integer $num
     */
    function removeFromEnd(string $text, int $num): string
    {
        return mb_substr($text, 0, (-1 * $num));
    }
}


if (!function_exists("zeroPadding")) {

    /**
     * num の前に0を digit 分埋める
     *
     * @param integer $digit
     * @param integer $num
     */
    function zeroPadding(int $digit, int $num): string
    {
        return sprintf("%0" . $digit . "d", $num);
    }
}


if (!function_exists("removeLineFeedCode")) {

    /**
     * text から改行コードを取り除く
     *
     * @param string $text
     */
    function removeLineFeedCode(string $text): string
    {
        return str_replace(["\r\n", "\r", "\n"], "", $text);
    }
}


if (!function_exists("removeSpace")) {

    /**
     * text からスペースを取り除く
     *
     * @param string $text
     */
    function removeSpace(string $text): string
    {
        return str_replace([" ", "　"], "", $text);
    }
}


if (!function_exists("removeDoubleBiteSpace")) {

    /**
     * text から全角スペースを取り除く
     *
     * @param string $text
     */
    function removeDoubleBiteSpace(string $text): string
    {
        return str_replace("　", "", $text);
    }
}


if (!function_exists("convertToHalfSpace")) {

    /**
     * text の全角スペースを半角スペースに変換する
     *
     * @param string $text
     */
    function convertToHalfSpace(string $text): string
    {
        return str_replace("　", " ", $text);
    }
}


if (!function_exists("convertHalfWidthNumeric")) {

    /**
     * text の中の全角数字を半角に変換する
     *
     * @param string $text
     */
    function convertHalfWidthNumeric(string $text): string
    {
        return mb_convert_kana($text, "n");
    }
}


if (!function_exists("toLower")) {

    /**
     * text を小文字に変換する
     *
     * @param string $text
     */
    function toLower(string $text): string
    {
        return Str::lower($text);
    }
}


if (!function_exists("toUpper")) {

    /**
     * text を大文字に変換する
     *
     * @param string $text
     */
    function toUpper(string $text): string
    {
        return Str::upper($text);
    }
}


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


if (!function_exists("isHiragana")) {

    /**
     * text がすべてひらがなで構成されているか
     *
     * @param string $text
     */
    function isHiragana(string $text): bool
    {
        return !preg_match("/[^ぁ-んー]/u", $text);
    }
}


if (!function_exists("isKatakana")) {

    /**
     * text がすべてカタカナで構成されているか
     *
     * @param string $text
     */
    function isKatakana(string $text): bool
    {
        return !preg_match("/[^ァ-ヶー]/u", $text);
    }
}


if (!function_exists("isKanji")) {

    /**
     * text がすべて漢字で構成されているか
     *
     * @param string $text
     */
    function isKanji(string $text): bool
    {
        return !preg_match("/[^一-龠]/u", $text);
    }
}


if (!function_exists("isAlphabet")) {

    /**
     * text がすべてアルファベットで構成されているか
     *
     * @param string $text
     */
    function isAlphabet(string $text): bool
    {
        return !preg_match("/[^a-zA-Z]/u", $text);
    }
}


if (!function_exists("isAlphabetUppercase")) {

    /**
     * text がすべて大文字のアルファベットで構成されているか
     *
     * @param string $text
     */
    function isAlphabetUppercase(string $text): bool
    {
        return !preg_match("/[^A-Z]/u", $text);
    }
}


if (!function_exists("isAlphabetLowercase")) {

    /**
     * text がすべて小文字のアルファベットで構成されているか
     *
     * @param string $text
     */
    function isAlphabetLowercase(string $text): bool
    {
        return !preg_match("/[^a-z]/u", $text);
    }
}


if (!function_exists("isAlphabetDoubleBite")) {

    /**
     * text がすべて全角アルファベットで構成されているか
     *
     * @param string $text
     */
    function isAlphabetDoubleBite(string $text): bool
    {
        return !preg_match("/[^ａ-ｚＡ-Ｚ]/u", $text);
    }
}


if (!function_exists("isAlphabetUppercaseDoubleBite")) {

    /**
     * text がすべて大文字の全角アルファベットで構成されているか
     *
     * @param string $text
     */
    function isAlphabetUppercaseDoubleBite(string $text): bool
    {
        return !preg_match("/[^Ａ-Ｚ]/u", $text);
    }
}


if (!function_exists("isAlphabetLowercaseDoubleBite")) {

    /**
     * text がすべて小文字の全角アルファベットで構成されているか
     *
     * @param string $text
     */
    function isAlphabetLowercaseDoubleBite(string $text): bool
    {
        return !preg_match("/[^ａ-ｚ]/u", $text);
    }
}
