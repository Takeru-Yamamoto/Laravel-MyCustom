<?php

use MyCustom\Consts\DayOfWeek;

if (!function_exists('isDayOdWeek')) {

    /**
     * dayOfWeek が const/dayOfWeek.php の list に含まれているか
     *
     * @param string $dayOfWeek
     */
    function isDayOdWeek(string $dayOfWeek): bool
    {
        return isset(DayOfWeek::DAY_OF_WEEKS[$dayOfWeek]);
    }
}


if (!function_exists('upperCaseDayOfWeek')) {

    /**
     * dayOfWeek をアッパーケースにする
     *
     * @param string $dayOfWeek
     */
    function upperCaseDayOfWeek(string $dayOfWeek): string
    {
        return isDayOdWeek($dayOfWeek) ? DayOfWeek::DAY_OF_WEEKS_UPPER_CASE[$dayOfWeek] : "";
    }
}


if (!function_exists('shortDayOfWeek')) {

    /**
     * dayOfWeek を3文字表記にする
     *
     * @param string $dayOfWeek
     */
    function shortDayOfWeek(string $dayOfWeek): string
    {
        return isDayOdWeek($dayOfWeek) ? DayOfWeek::DAY_OF_WEEKS_SHORT[$dayOfWeek] : "";
    }
}


if (!function_exists('shortUpperCaseDayOfWeek')) {

    /**
     * dayOfWeek を3文字表記のアッパーケースにする
     *
     * @param string $dayOfWeek
     */
    function shortUpperCaseDayOfWeek(string $dayOfWeek): string
    {
        return isDayOdWeek($dayOfWeek) ? DayOfWeek::DAY_OF_WEEKS_SHORT_UPPER_CASE[$dayOfWeek] : "";
    }
}


if (!function_exists('kanjiDayOfWeek')) {

    /**
     * dayOfWeek を漢字表記にする
     *
     * @param string $dayOfWeek
     */
    function kanjiDayOfWeek(string $dayOfWeek): string
    {
        return isDayOdWeek($dayOfWeek) ? DayOfWeek::DAY_OF_WEEKS_KANJI[$dayOfWeek] : "";
    }
}


if (!function_exists('fullKanjiDayOfWeek')) {

    /**
     * dayOfWeek を "曜日" まで含めた表記にする
     *
     * @param string $dayOfWeek
     */
    function fullKanjiDayOfWeek(string $dayOfWeek): string
    {
        return isDayOdWeek($dayOfWeek) ? DayOfWeek::DAY_OF_WEEKS_KANJI_FULL[$dayOfWeek] : "";
    }
}
