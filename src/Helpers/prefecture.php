<?php

use MyCustom\Consts\Prefecture;

if (!function_exists('isPrefecture')) {

    /**
     * prefecture が const/prefecture.php の list に含まれているか
     *
     * @param string $prefecture
     */
    function isPrefecture(string $prefecture): bool
    {
        return isset(Prefecture::PREFECTURES[$prefecture]);
    }
}


if (!function_exists('upperCasePrefecture')) {

    /**
     * prefecture をアッパーケースにする
     *
     * @param string $prefecture
     */
    function upperCasePrefecture(string $prefecture): string
    {
        return isPrefecture($prefecture) ? Prefecture::PREFECTURES_UPPER_CASE[$prefecture] : "";
    }
}


if (!function_exists('kanjiPrefecture')) {

    /**
     * prefecture を漢字表記にする
     *
     * @param string $prefecture
     */
    function kanjiPrefecture(string $prefecture): string
    {
        return isPrefecture($prefecture) ? Prefecture::PREFECTURES_KANJI[$prefecture] : "";
    }
}


if (!function_exists('fullKanjiPrefecture')) {

    /**
     * prefecture を都道府県表記まで含めた漢字表記にする
     *
     * @param string $prefecture
     */
    function fullKanjiPrefecture(string $prefecture): string
    {
        return isPrefecture($prefecture) ? Prefecture::PREFECTURES_KANJI_FULL[$prefecture] : "";
    }
}


if (!function_exists('isRegion')) {

    /**
     * region が const/prefecture.php の region に含まれているか
     *
     * @param string $region
     */
    function isRegion(string $region): bool
    {
        return isset(Prefecture::REGIONS[$region]);
    }
}


if (!function_exists('upperCaseRegion')) {

    /**
     * region をアッパーケースにする
     *
     * @param string $region
     */
    function upperCaseRegion(string $region): string
    {
        return isRegion($region) ? Prefecture::REGIONS_UPPER_CASE[$region] : "";
    }
}


if (!function_exists('kanjiRegion')) {

    /**
     * region を漢字表記にする
     *
     * @param string $region
     */
    function kanjiRegion(string $region): string
    {
        return isRegion($region) ? Prefecture::REGIONS_KANJI[$region] : "";
    }
}


if (!function_exists('convertToRegionFromPrefecture')) {

    /**
     * prefecture を region に変換する
     *
     * @param string $prefecture
     */
    function convertToRegionFromPrefecture(string $prefecture): string
    {
        return isPrefecture($prefecture) ? Prefecture::PREFECTURE_REGION[$prefecture] : "";
    }
}
