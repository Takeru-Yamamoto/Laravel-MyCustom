<?php

namespace MyCustom\Enums;

use MyCustom\Enums\EnumTrait;

enum DayOfWeekEnum: string
{
    case SUNDAY    = "sunday";
    case MONDAY    = "monday";
    case TUESDAY   = "tuesday";
    case WEDNESDAY = "wednesday";
    case THURSDAY  = "thursday";
    case FRIDAY    = "friday";
    case SATURDAY  = "saturday";

    use EnumTrait;

    /* Upper Case */
    public function upperCase(): string
    {
        return ucfirst($this->value);
    }

    public static function fromUpperCase(string $upperCase): static
    {
        return match ($upperCase) {
            self::SUNDAY->upperCase()    => self::SUNDAY,
            self::MONDAY->upperCase()    => self::MONDAY,
            self::TUESDAY->upperCase()   => self::TUESDAY,
            self::WEDNESDAY->upperCase() => self::WEDNESDAY,
            self::THURSDAY->upperCase()  => self::THURSDAY,
            self::FRIDAY->upperCase()    => self::FRIDAY,
            self::SATURDAY->upperCase()  => self::SATURDAY,

            default => throw new \RuntimeException("Invalid upper case day of week: {$upperCase}"),
        };
    }

    public static function tryFromUpperCase(string $upperCase): ?static
    {
        try {
            return self::fromUpperCase($upperCase);
        } catch (\Throwable) {
            return null;
        }
    }


    /* Short */
    public function short(): string
    {
        return substr($this->value, 0, 3);
    }

    public static function fromShort(string $short): static
    {
        return match ($short) {
            self::SUNDAY->short()    => self::SUNDAY,
            self::MONDAY->short()    => self::MONDAY,
            self::TUESDAY->short()   => self::TUESDAY,
            self::WEDNESDAY->short() => self::WEDNESDAY,
            self::THURSDAY->short()  => self::THURSDAY,
            self::FRIDAY->short()    => self::FRIDAY,
            self::SATURDAY->short()  => self::SATURDAY,

            default => throw new \RuntimeException("Invalid short day of week: {$short}"),
        };
    }

    public static function tryFromShort(string $short): ?static
    {
        try {
            return self::fromShort($short);
        } catch (\Throwable) {
            return null;
        }
    }


    /* Short Upper Case */
    public function shortUpperCase(): string
    {
        return ucfirst($this->short());
    }

    public static function fromShortUpperCase(string $shortUpperCase): static
    {
        return match ($shortUpperCase) {
            self::SUNDAY->shortUpperCase()    => self::SUNDAY,
            self::MONDAY->shortUpperCase()    => self::MONDAY,
            self::TUESDAY->shortUpperCase()   => self::TUESDAY,
            self::WEDNESDAY->shortUpperCase() => self::WEDNESDAY,
            self::THURSDAY->shortUpperCase()  => self::THURSDAY,
            self::FRIDAY->shortUpperCase()    => self::FRIDAY,
            self::SATURDAY->shortUpperCase()  => self::SATURDAY,

            default => throw new \RuntimeException("Invalid short upper case day of week: {$shortUpperCase}"),
        };
    }

    public static function tryFromShortUpperCase(string $shortUpperCase): ?static
    {
        try {
            return self::fromShortUpperCase($shortUpperCase);
        } catch (\Throwable) {
            return null;
        }
    }


    /* Kanji */
    public function kanji(): string
    {
        return match ($this) {
            self::SUNDAY    => "日",
            self::MONDAY    => "月",
            self::TUESDAY   => "火",
            self::WEDNESDAY => "水",
            self::THURSDAY  => "木",
            self::FRIDAY    => "金",
            self::SATURDAY  => "土",
        };
    }

    public static function fromKanji(string $kanji): static
    {
        return match ($kanji) {
            self::SUNDAY->kanji()    => self::SUNDAY,
            self::MONDAY->kanji()    => self::MONDAY,
            self::TUESDAY->kanji()   => self::TUESDAY,
            self::WEDNESDAY->kanji() => self::WEDNESDAY,
            self::THURSDAY->kanji()  => self::THURSDAY,
            self::FRIDAY->kanji()    => self::FRIDAY,
            self::SATURDAY->kanji()  => self::SATURDAY,

            default => throw new \RuntimeException("Invalid kanji day of week: {$kanji}"),
        };
    }

    public static function tryFromKanji(string $kanji): ?static
    {
        try {
            return self::fromKanji($kanji);
        } catch (\Throwable) {
            return null;
        }
    }


    /* Kanji Full */
    public function kanjiFull(): string
    {
        return match ($this) {
            self::SUNDAY    => "日曜日",
            self::MONDAY    => "月曜日",
            self::TUESDAY   => "火曜日",
            self::WEDNESDAY => "水曜日",
            self::THURSDAY  => "木曜日",
            self::FRIDAY    => "金曜日",
            self::SATURDAY  => "土曜日",
        };
    }

    public static function fromKanjiFull(string $kanjiFull): static
    {
        return match ($kanjiFull) {
            self::SUNDAY->kanjiFull()    => self::SUNDAY,
            self::MONDAY->kanjiFull()    => self::MONDAY,
            self::TUESDAY->kanjiFull()   => self::TUESDAY,
            self::WEDNESDAY->kanjiFull() => self::WEDNESDAY,
            self::THURSDAY->kanjiFull()  => self::THURSDAY,
            self::FRIDAY->kanjiFull()    => self::FRIDAY,
            self::SATURDAY->kanjiFull()  => self::SATURDAY,

            default => throw new \RuntimeException("Invalid kanji full day of week: {$kanjiFull}"),
        };
    }

    public static function tryFromKanjiFull(string $kanjiFull): ?static
    {
        try {
            return self::fromKanjiFull($kanjiFull);
        } catch (\Throwable) {
            return null;
        }
    }
}
