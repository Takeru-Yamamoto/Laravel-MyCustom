<?php

namespace MyCustom\Utils\Date;

use MyCustom\Jsonables\BaseJsonable;

use Carbon\Carbon;

final class DateUtil extends BaseJsonable
{
    public readonly Carbon $carbon;

    function __construct(string|Carbon|null $date = null)
    {
        $this->carbon = $date instanceof Carbon ? $date : new Carbon($date);
    }

    /* format */
    public function format(string $format): string
    {
        return $this->carbon->format($format);
    }
    public function toDate(string $year = "Y", string $month = "m", string $day = "d", string $separator = "-"): string
    {
        return $this->format($year . $separator . $month . $separator . $day);
    }
    public function toTime(string $hour = "H", string $minute = "i", string $second = "s", string $separator = ":"): string
    {
        return $this->format($hour . $separator . $minute . $separator . $second);
    }
    public function toDatetime(
        string $year = "Y",
        string $month = "m",
        string $day = "d",
        string $dateSeparator = "-",
        string $hour = "H",
        string $minute = "i",
        string $second = "s",
        string $timeSeparator = ":",
    ): string {
        return $this->format($year . $dateSeparator . $month . $dateSeparator . $day . " " . $hour . $timeSeparator . $minute . $timeSeparator . $second);
    }


    /* to string */
    public function toDateString(): string
    {
        return $this->carbon->toDateString();
    }
    public function toDatetimeString(): string
    {
        return $this->carbon->toDateTimeString();
    }
    public function toTimeString(): string
    {
        return $this->carbon->toTimeString();
    }


    /* getter */
    public function year(): int
    {
        return $this->carbon->year;
    }
    public function month(): int
    {
        return $this->carbon->month;
    }
    public function day(): int
    {
        return $this->carbon->day;
    }
    public function hour(): int
    {
        return $this->carbon->hour;
    }
    public function minute(): int
    {
        return $this->carbon->minute;
    }
    public function second(): int
    {
        return $this->carbon->second;
    }
    public function dayOfYear(): int
    {
        return $this->carbon->dayOfYear;
    }
    public function weekOfYear(): int
    {
        return $this->carbon->weekOfYear;
    }
    public function daysInMonth(): int
    {
        return $this->carbon->daysInMonth;
    }
    public function weekNumberInMonth(): int
    {
        return $this->carbon->weekNumberInMonth;
    }
    public function yearsAgo(int $subYears): int
    {
        return $this->subYear($subYears)->year();
    }
    public function age(): int
    {
        return $this->carbon->age;
    }
    public function firstOfMonth(): string
    {
        return $this->carbon->firstOfMonth()->toDateTimeString();
    }
    public function endOfMonth(): string
    {
        return $this->carbon->endOfMonth()->toDateTimeString();
    }
    public function startOfWeek(): string
    {
        return $this->carbon->startOfWeek()->toDateTimeString();
    }
    public function endOfWeek(): string
    {
        return $this->carbon->endOfWeek()->toDateTimeString();
    }
    public function startOfDay(): string
    {
        return $this->carbon->startOfDay()->toDateTimeString();
    }
    public function endOfDay(): string
    {
        return $this->carbon->endOfDay()->toDateTimeString();
    }


    /* setter */
    public function setYear(int $year): static
    {
        $this->carbon->setDateTime($year, $this->month(), $this->day(), $this->hour(), $this->minute(), $this->second());
        return $this;
    }
    public function setMonth(int $month): static
    {
        $this->carbon->setDateTime($this->year(), $month, $this->day(), $this->hour(), $this->minute(), $this->second());
        return $this;
    }
    public function setDay(int $day): static
    {
        $this->carbon->setDateTime($this->year(), $this->month(), $day, $this->hour(), $this->minute(), $this->second());
        return $this;
    }
    public function setHour(int $hour): static
    {
        $this->carbon->setDateTime($this->year(), $this->month(), $this->day(), $hour, $this->minute(), $this->second());
        return $this;
    }
    public function setMinute(int $minute): static
    {
        $this->carbon->setDateTime($this->year(), $this->month(), $this->day(), $this->hour(), $minute, $this->second());
        return $this;
    }
    public function setSecond(int $second): static
    {
        $this->carbon->setDateTime($this->year(), $this->month(), $this->day(), $this->hour(), $this->minute(), $second);
        return $this;
    }


    /* calculation */
    public function addYear(int $year): static
    {
        $this->carbon->addYearsNoOverflow($year);
        return $this;
    }
    public function addYearWithOverflow(int $year): static
    {
        $this->carbon->addYearsWithOverflow($year);
        return $this;
    }
    public function subYear(int $year): static
    {
        $this->carbon->subYearsNoOverflow($year);
        return $this;
    }
    public function subYearWithOverflow(int $year): static
    {
        $this->carbon->subYearsWithOverflow($year);
        return $this;
    }
    public function diffYear(string|Carbon|null $date = null): int
    {
        return $this->carbon->diffInYears($date);
    }
    public function addMonth(int $month): static
    {
        $this->carbon->addMonthsNoOverflow($month);
        return $this;
    }
    public function addMonthWithOverflow(int $month): static
    {
        $this->carbon->addMonthsWithOverflow($month);
        return $this;
    }
    public function subMonth(int $month): static
    {
        $this->carbon->subMonthsNoOverflow($month);
        return $this;
    }
    public function subMonthWithOverflow(int $month): static
    {
        $this->carbon->subMonthsWithOverflow($month);
        return $this;
    }
    public function diffMonth(string|Carbon|null $date = null): int
    {
        return $this->carbon->diffInMonths($date);
    }
    public function addWeek(int $week): static
    {
        $this->carbon->addDays($week * 7);
        return $this;
    }
    public function subWeek(int $week): static
    {
        $this->carbon->subDays($week * 7);
        return $this;
    }
    public function diffWeek(string|Carbon|null $date = null): int
    {
        return $this->carbon->diffInWeeks($date);
    }
    public function addDay(int $day): static
    {
        $this->carbon->addDays($day);
        return $this;
    }
    public function subDay(int $day): static
    {
        $this->carbon->subDays($day);
        return $this;
    }
    public function diffDay(string|Carbon|null $date = null): int
    {
        return $this->carbon->diffInDays($date);
    }
    public function addHour(int $hour): static
    {
        $this->carbon->addHours($hour);
        return $this;
    }
    public function subHour(int $hour): static
    {
        $this->carbon->subHours($hour);
        return $this;
    }
    public function diffHour(string|Carbon|null $date = null): int
    {
        return $this->carbon->diffInHours($date);
    }
    public function addMinute(int $minute): static
    {
        $this->carbon->addMinutes($minute);
        return $this;
    }
    public function subMinute(int $minute): static
    {
        $this->carbon->subMinutes($minute);
        return $this;
    }
    public function diffMinute(string|Carbon|null $date = null): int
    {
        return $this->carbon->diffInMinutes($date);
    }
    public function addSecond(int $second): static
    {
        $this->carbon->addSeconds($second);
        return $this;
    }
    public function subSecond(int $second): static
    {
        $this->carbon->subSeconds($second);
        return $this;
    }
    public function diffSecond(string|Carbon|null $date = null): int
    {
        return $this->carbon->diffInSeconds($date);
    }


    /* check */
    public function isMonday(): bool
    {
        return $this->carbon->isMonday();
    }
    public function isTuesday(): bool
    {
        return $this->carbon->isTuesday();
    }
    public function isWednesday(): bool
    {
        return $this->carbon->isWednesday();
    }
    public function isThursDay(): bool
    {
        return $this->carbon->isThursDay();
    }
    public function isFriday(): bool
    {
        return $this->carbon->isFriday();
    }
    public function isSaturday(): bool
    {
        return $this->carbon->isSaturday();
    }
    public function isSunday(): bool
    {
        return $this->carbon->isSunday();
    }
    public function isWeekday(): bool
    {
        return $this->carbon->isWeekday();
    }
    public function isWeekend(): bool
    {
        return $this->carbon->isWeekend();
    }
    public function isToday(): bool
    {
        return $this->carbon->isToday();
    }
    public function isLast(): bool
    {
        return $this->carbon->isLastOfMonth();
    }
    public function isFuture(): bool
    {
        return $this->carbon->isFuture();
    }
    public function isPast(): bool
    {
        return $this->carbon->isPast();
    }
    public function isEqual(string|Carbon|null $comparator = null): bool
    {
        return $this->carbon->eq($comparator);
    }
    public function isGreater(string|Carbon|null $comparator = null): bool
    {
        return $this->carbon->gt($comparator);
    }
    public function isGreaterEqual(string|Carbon|null $comparator = null): bool
    {
        return $this->carbon->gte($comparator);
    }
    public function isLess(string|Carbon|null $comparator = null): bool
    {
        return $this->carbon->lt($comparator);
    }
    public function isLessEqual(string|Carbon|null $comparator = null): bool
    {
        return $this->carbon->lte($comparator);
    }
}
