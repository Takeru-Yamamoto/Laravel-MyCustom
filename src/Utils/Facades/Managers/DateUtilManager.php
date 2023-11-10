<?php

namespace MyCustom\Utils\Facades\Managers;

use MyCustom\Utils\Date\DateUtil;

use MyCustom\Utils\Facades\Date as DateUtilFacade;

use Carbon\Carbon;

final class DateUtilManager
{
    public function make(string|Carbon|null $date = null): DateUtil
    {
        return new DateUtil($date);
    }


    /* format */
    public function format(string|Carbon|null $date = null, string $format = DateUtilFacade::FORMAT_DATE_JP): string
    {
        return $this->make($date)->format($format);
    }

    public function toDate(string|Carbon|null $date = null, string $year = "Y", string $month = "m", string $day = "d", string $separator = "-"): string
    {
        return $this->make($date)->toDate($year, $month, $day, $separator);
    }

    public function toTime(string|Carbon|null $date = null, string $hour = "H", string $minute = "i", string $second = "s", string $separator = ":"): string
    {
        return $this->make($date)->toTime($hour, $minute, $second, $separator);
    }

    public function toDatetime(
        string|Carbon|null $date = null,
        string $year = "Y",
        string $month = "m",
        string $day = "d",
        string $dateSeparator = "-",
        string $hour = "H",
        string $minute = "i",
        string $second = "s",
        string $timeSeparator = ":",
    ): string {
        return $this->make($date)->toDatetime(
            $year,
            $month,
            $day,
            $dateSeparator,
            $hour,
            $minute,
            $second,
            $timeSeparator
        );
    }


    /* getter */
    public function year(string|Carbon|null $date = null): int
    {
        return $this->make($date)->year();
    }

    public function month(string|Carbon|null $date = null): int
    {
        return $this->make($date)->month();
    }

    public function day(string|Carbon|null $date = null): int
    {
        return $this->make($date)->day();
    }

    public function hour(string|Carbon|null $date = null): int
    {
        return $this->make($date)->hour();
    }

    public function minute(string|Carbon|null $date = null): int
    {
        return $this->make($date)->minute();
    }

    public function second(string|Carbon|null $date = null): int
    {
        return $this->make($date)->second();
    }

    public function dayOfYear(string|Carbon|null $date = null): int
    {
        return $this->make($date)->dayOfYear();
    }

    public function weekOfYear(string|Carbon|null $date = null): int
    {
        return $this->make($date)->weekOfYear();
    }

    public function daysInMonth(string|Carbon|null $date = null): int
    {
        return $this->make($date)->daysInMonth();
    }

    public function weekNumberInMonth(string|Carbon|null $date = null): int
    {
        return $this->make($date)->weekNumberInMonth();
    }

    public function yearsAgo(string|Carbon|null $date = null, int $subYears = 0): int
    {
        return $this->make($date)->yearsAgo($subYears);
    }

    public function age(string|Carbon|null $date = null): int
    {
        return $this->make($date)->age();
    }

    public function firstOfMonth(string|Carbon|null $date = null): string
    {
        return $this->make($date)->firstOfMonth();
    }

    public function endOfMonth(string|Carbon|null $date = null): string
    {
        return $this->make($date)->endOfMonth();
    }

    public function startOfWeek(string|Carbon|null $date = null): string
    {
        return $this->make($date)->startOfWeek();
    }

    public function endOfWeek(string|Carbon|null $date = null): string
    {
        return $this->make($date)->endOfWeek();
    }

    public function startOfDay(string|Carbon|null $date = null): string
    {
        return $this->make($date)->startOfDay();
    }

    public function endOfDay(string|Carbon|null $date = null): string
    {
        return $this->make($date)->endOfDay();
    }


    /* calculation */
    public function addYear(string|Carbon|null $date = null, int $year = 0): int
    {
        return $this->make($date)->addYear($year)->year();
    }

    public function addYearWithOverflow(string|Carbon|null $date = null, int $year = 0): int
    {
        return $this->make($date)->addYearWithOverflow($year)->year();
    }

    public function subYear(string|Carbon|null $date = null, int $year = 0): int
    {
        return $this->make($date)->subYear($year)->year();
    }

    public function subYearWithOverflow(string|Carbon|null $date = null, int $year = 0): int
    {
        return $this->make($date)->subYearWithOverflow($year)->year();
    }

    public function addMonth(string|Carbon|null $date = null, int $month = 0): int
    {
        return $this->make($date)->addMonth($month)->month();
    }

    public function addMonthWithOverflow(string|Carbon|null $date = null, int $month = 0): int
    {
        return $this->make($date)->addMonthWithOverflow($month)->month();
    }

    public function subMonth(string|Carbon|null $date = null, int $month = 0): int
    {
        return $this->make($date)->subMonth($month)->month();
    }

    public function subMonthWithOverflow(string|Carbon|null $date = null, int $month = 0): int
    {
        return $this->make($date)->subMonthWithOverflow($month)->month();
    }

    public function addWeek(string|Carbon|null $date = null, int $week = 0): int
    {
        return $this->make($date)->addWeek($week)->weekNumberInMonth();
    }

    public function subWeek(string|Carbon|null $date = null, int $week = 0): int
    {
        return $this->make($date)->subWeek($week)->weekNumberInMonth();
    }

    public function addDay(string|Carbon|null $date = null, int $day = 0): int
    {
        return $this->make($date)->addDay($day)->day();
    }

    public function subDay(string|Carbon|null $date = null, int $day = 0): int
    {
        return $this->make($date)->subDay($day)->day();
    }

    public function addHour(string|Carbon|null $date = null, int $hour = 0): int
    {
        return $this->make($date)->addHour($hour)->hour();
    }

    public function subHour(string|Carbon|null $date = null, int $hour = 0): int
    {
        return $this->make($date)->subHour($hour)->hour();
    }

    public function addMinute(string|Carbon|null $date = null, int $minute = 0): int
    {
        return $this->make($date)->addMinute($minute)->minute();
    }

    public function subMinute(string|Carbon|null $date = null, int $minute = 0): int
    {
        return $this->make($date)->subMinute($minute)->minute();
    }

    public function addSecond(string|Carbon|null $date = null, int $second = 0): int
    {
        return $this->make($date)->addSecond($second)->second();
    }

    public function subSecond(string|Carbon|null $date = null, int $second = 0): int
    {
        return $this->make($date)->subSecond($second)->second();
    }

    public function diffYear(string|Carbon|null $date = null, string|Carbon|null $comparator = null): int
    {
        return $this->make($date)->diffYear($comparator);
    }

    public function diffMonth(string|Carbon|null $date = null, string|Carbon|null $comparator = null): int
    {
        return $this->make($date)->diffMonth($comparator);
    }

    public function diffWeek(string|Carbon|null $date = null, string|Carbon|null $comparator = null): int
    {
        return $this->make($date)->diffWeek($comparator);
    }

    public function diffDay(string|Carbon|null $date = null, string|Carbon|null $comparator = null): int
    {
        return $this->make($date)->diffDay($comparator);
    }

    public function diffHour(string|Carbon|null $date = null, string|Carbon|null $comparator = null): int
    {
        return $this->make($date)->diffHour($comparator);
    }

    public function diffMinute(string|Carbon|null $date = null, string|Carbon|null $comparator = null): int
    {
        return $this->make($date)->diffMinute($comparator);
    }

    public function diffSecond(string|Carbon|null $date = null, string|Carbon|null $comparator = null): int
    {
        return $this->make($date)->diffSecond($comparator);
    }


    /* check */
    public function isMatchFormat(string $date, string $format): bool
    {
        return Carbon::hasFormat($date, $format);
    }

    public function isMonday(string|Carbon|null $date = null): bool
    {
        return $this->make($date)->isMonday();
    }

    public function isTuesday(string|Carbon|null $date = null): bool
    {
        return $this->make($date)->isTuesday();
    }

    public function isWednesday(string|Carbon|null $date = null): bool
    {
        return $this->make($date)->isWednesday();
    }

    public function isThursDay(string|Carbon|null $date = null): bool
    {
        return $this->make($date)->isThursDay();
    }

    public function isFriday(string|Carbon|null $date = null): bool
    {
        return $this->make($date)->isFriday();
    }

    public function isSaturday(string|Carbon|null $date = null): bool
    {
        return $this->make($date)->isSaturday();
    }

    public function isSunday(string|Carbon|null $date = null): bool
    {
        return $this->make($date)->isSunday();
    }

    public function isWeekday(string|Carbon|null $date = null): bool
    {
        return $this->make($date)->isWeekday();
    }

    public function isWeekend(string|Carbon|null $date = null): bool
    {
        return $this->make($date)->isWeekend();
    }

    public function isToday(string|Carbon|null $date = null): bool
    {
        return $this->make($date)->isToday();
    }

    public function isLast(string|Carbon|null $date = null): bool
    {
        return $this->make($date)->isLast();
    }

    public function isFuture(string|Carbon|null $date = null): bool
    {
        return $this->make($date)->isFuture();
    }

    public function isPast(string|Carbon|null $date = null): bool
    {
        return $this->make($date)->isPast();
    }

    public function isEqual(string|Carbon|null $date = null, string|Carbon|null $comparator = null): bool
    {
        return $this->make($date)->isEqual($comparator);
    }

    public function isGreater(string|Carbon|null $date = null, string|Carbon|null $comparator = null): bool
    {
        return $this->make($date)->isGreater($comparator);
    }

    public function isGreaterEqual(string|Carbon|null $date = null, string|Carbon|null $comparator = null): bool
    {
        return $this->make($date)->isGreaterEqual($comparator);
    }

    public function isLess(string|Carbon|null $date = null, string|Carbon|null $comparator = null): bool
    {
        return $this->make($date)->isLess($comparator);
    }

    public function isLessEqual(string|Carbon|null $date = null, string|Carbon|null $comparator = null): bool
    {
        return $this->make($date)->isLessEqual($comparator);
    }
}
