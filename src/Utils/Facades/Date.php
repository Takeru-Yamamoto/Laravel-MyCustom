<?php

namespace MyCustom\Utils\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \MyCustom\Utils\Date\DateUtil make(string|Carbon|null $date = null)
 * 
 * @method static string format(string|Carbon|null $date = null, string $format = self::FORMAT_DATE_JP)
 * @method static string toDate(string|Carbon|null $date = null, string $year = "Y", string $month = "m", string $day = "d", string $separator = "-")
 * @method static string toTime(string|Carbon|null $date = null, string $hour = "H", string $minute = "i", string $second = "s", string $separator = ":")
 * @method static string toDatetime(string|Carbon|null $date = null, string $year = "Y", string $month = "m", string $day = "d", string $dateSeparator = "-", string $hour = "H", string $minute = "i", string $second = "s", string $separator = ":")
 * 
 * @method static int year(string|Carbon|null $date = null)
 * @method static int month(string|Carbon|null $date = null)
 * @method static int day(string|Carbon|null $date = null)
 * @method static int hour(string|Carbon|null $date = null)
 * @method static int minute(string|Carbon|null $date = null)
 * @method static int second(string|Carbon|null $date = null)
 * @method static int dayOfYear(string|Carbon|null $date = null)
 * @method static int weekOfYear(string|Carbon|null $date = null)
 * @method static int daysInMonth(string|Carbon|null $date = null)
 * @method static int weekNumberInMonth(string|Carbon|null $date = null)
 * @method static int yearsAgo(string|Carbon|null $date = null, int $subYears = 0)
 * @method static int age(string|Carbon|null $date = null)
 * @method static string firstOfMonth(string|Carbon|null $date = null)
 * @method static string endOfMonth(string|Carbon|null $date = null)
 * @method static string startOfWeek(string|Carbon|null $date = null)
 * @method static string endOfWeek(string|Carbon|null $date = null)
 * @method static string startOfDay(string|Carbon|null $date = null)
 * @method static string endOfDay(string|Carbon|null $date = null)
 * 
 * @method static int addYear(string|Carbon|null $date = null, int $year = 0)
 * @method static int addYearWithOverflow(string|Carbon|null $date = null, int $year = 0)
 * @method static int subYear(string|Carbon|null $date = null, int $year = 0)
 * @method static int subYearWithOverflow(string|Carbon|null $date = null, int $year = 0)
 * @method static int addMonth(string|Carbon|null $date = null, int $month = 0)
 * @method static int addMonthWithOverflow(string|Carbon|null $date = null, int $month = 0)
 * @method static int subMonth(string|Carbon|null $date = null, int $month = 0)
 * @method static int subMonthWithOverflow(string|Carbon|null $date = null, int $month = 0)
 * @method static int addWeek(string|Carbon|null $date = null, int $week = 0)
 * @method static int subWeek(string|Carbon|null $date = null, int $week = 0)
 * @method static int addDay(string|Carbon|null $date = null, int $day = 0)
 * @method static int subDay(string|Carbon|null $date = null, int $day = 0)
 * @method static int addHour(string|Carbon|null $date = null, int $hour = 0)
 * @method static int subHour(string|Carbon|null $date = null, int $hour = 0)
 * @method static int addMinute(string|Carbon|null $date = null, int $minute = 0)
 * @method static int subMinute(string|Carbon|null $date = null, int $minute = 0)
 * @method static int addSecond(string|Carbon|null $date = null, int $second = 0)
 * @method static int subSecond(string|Carbon|null $date = null, int $second = 0)
 * @method static int diffYear(string|Carbon|null $date = null, string|Carbon|null $comparator = null)
 * @method static int diffMonth(string|Carbon|null $date = null, string|Carbon|null $comparator = null)
 * @method static int diffWeek(string|Carbon|null $date = null, string|Carbon|null $comparator = null)
 * @method static int diffDay(string|Carbon|null $date = null, string|Carbon|null $comparator = null)
 * @method static int diffHour(string|Carbon|null $date = null, string|Carbon|null $comparator = null)
 * @method static int diffMinute(string|Carbon|null $date = null, string|Carbon|null $comparator = null)
 * @method static int diffSecond(string|Carbon|null $date = null, string|Carbon|null $comparator = null)
 * 
 * @method static bool isMatchFormat(string $date, string $format)
 * @method static bool isMonday(string|Carbon|null $date = null)
 * @method static bool isTuesday(string|Carbon|null $date = null)
 * @method static bool isWednesday(string|Carbon|null $date = null)
 * @method static bool isThursDay(string|Carbon|null $date = null)
 * @method static bool isFriday(string|Carbon|null $date = null)
 * @method static bool isSaturday(string|Carbon|null $date = null)
 * @method static bool isSunday(string|Carbon|null $date = null)
 * @method static bool isWeekday(string|Carbon|null $date = null)
 * @method static bool isWeekend(string|Carbon|null $date = null)
 * @method static bool isToday(string|Carbon|null $date = null)
 * @method static bool isLast(string|Carbon|null $date = null)
 * @method static bool isFuture(string|Carbon|null $date = null)
 * @method static bool isPast(string|Carbon|null $date = null)
 * @method static bool isEqual(string|Carbon|null $date = null, string|Carbon|null $comparator = null)
 * @method static bool isGreater(string|Carbon|null $date = null, string|Carbon|null $comparator = null)
 * @method static bool isGreaterEqual(string|Carbon|null $date = null, string|Carbon|null $comparator = null)
 * @method static bool isLess(string|Carbon|null $date = null, string|Carbon|null $comparator = null)
 * @method static bool isLessEqual(string|Carbon|null $date = null, string|Carbon|null $comparator = null)
 * 
 * @see \MyCustom\Utils\Facades\Managers\DateUtilManager
 */
class Date extends Facade
{
    /** 
     * Get the registered name of the component. 
     * 
     * @return string 
     */
    protected static function getFacadeAccessor()
    {
        return "DateUtil";
    }

    public const FORMAT_DATETIME = "Y-m-d H:i:s";

    public const FORMAT_DATE            = "Y-m-d";
    public const FORMAT_DATE_YEAR_MONTH = "Y-m";
    public const FORMAT_DATE_MONTH_DAY  = "m-d";
    public const FORMAT_DATE_SHORT      = "Ymd";

    public const FORMAT_TIME               = "H:i:s";
    public const FORMAT_TIME_HOUR_MINUTE   = "H:i";
    public const FORMAT_TIME_MINUTE_SECOND = "i:s";
    public const FORMAT_TIME_SHORT         = "His";


    public const FORMAT_DATETIME_JP = "Y年n月j日 G時i分s秒";

    public const FORMAT_DATE_JP            = "Y年n月j日";
    public const FORMAT_DATE_YEAR_MONTH_JP = "Y年n月";
    public const FORMAT_DATE_MONTH_DAY_JP  = "n月j日";

    public const FORMAT_TIME_JP_JP            = "G時i分s秒";
    public const FORMAT_TIME_HOUR_MINUTE_JP   = "G時i分";
    public const FORMAT_TIME_MINUTE_SECOND_JP = "i分s秒";
}
