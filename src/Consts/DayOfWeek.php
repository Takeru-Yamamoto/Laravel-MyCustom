<?php

namespace MyCustom\Consts;

/**
 * 曜日に関する定義
 */
class DayOfWeek
{
    public const DAY_OF_WEEKS = [
        "sunday",
        "monday",
        "tuesday",
        "wednesday",
        "thursday",
        "friday",
        "saturday",
    ];

    public const DAY_OF_WEEKS_UPPER_CASE = [
        "sunday"    => "Sunday",
        "monday"    => "Monday",
        "tuesday"   => "Tuesday",
        "wednesday" => "Wednesday",
        "thursday"  => "Thursday",
        "friday"    => "Friday",
        "saturday"  => "Saturday",
    ];

    public const DAY_OF_WEEKS_SHORT = [
        "sunday"    => "sun",
        "monday"    => "mon",
        "tuesday"   => "tue",
        "wednesday" => "wed",
        "thursday"  => "thu",
        "friday"    => "fri",
        "saturday"  => "sat",
    ];

    public const DAY_OF_WEEKS_SHORT_UPPER_CASE = [
        "sunday"    => "Sun",
        "monday"    => "Mon",
        "tuesday"   => "Tue",
        "wednesday" => "Wed",
        "thursday"  => "Thu",
        "friday"    => "Fri",
        "saturday"  => "Sat",
    ];

    public const DAY_OF_WEEKS_KANJI = [
        "sunday"    => "日",
        "monday"    => "月",
        "tuesday"   => "火",
        "wednesday" => "水",
        "thursday"  => "木",
        "friday"    => "金",
        "saturday"  => "土",
    ];

    public const DAY_OF_WEEKS_KANJI_FULL = [
        "sunday"    => "日曜日",
        "monday"    => "月曜日",
        "tuesday"   => "火曜日",
        "wednesday" => "水曜日",
        "thursday"  => "木曜日",
        "friday"    => "金曜日",
        "saturday"  => "土曜日",
    ];
}
