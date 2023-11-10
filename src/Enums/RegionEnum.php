<?php

namespace MyCustom\Enums;

use MyCustom\Enums\EnumTrait;

enum RegionEnum: string
{
    case HOKKAIDO = "hokkaido";
    case TOHOKU   = "tohoku";
    case KANTO    = "kanto";
    case CHUBU    = "chubu";
    case KINKI    = "kinki";
    case CHUGOKU  = "chugoku";
    case SHIKOKU  = "shikoku";
    case KYUSHU   = "kyushu";

    use EnumTrait;

    /* Upper Case */
    public function upperCase(): string
    {
        return ucfirst($this->value);
    }

    public static function fromUpperCase(string $upperCase): static
    {
        return match ($upperCase) {
            self::HOKKAIDO->upperCase() => self::HOKKAIDO,
            self::TOHOKU->upperCase()   => self::TOHOKU,
            self::KANTO->upperCase()    => self::KANTO,
            self::CHUBU->upperCase()    => self::CHUBU,
            self::KINKI->upperCase()    => self::KINKI,
            self::CHUGOKU->upperCase()  => self::CHUGOKU,
            self::SHIKOKU->upperCase()  => self::SHIKOKU,
            self::KYUSHU->upperCase()   => self::KYUSHU,

            default => throw new \RuntimeException("Invalid upper case region: {$upperCase}"),
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


    /* Kanji */
    public function kanji(): string
    {
        return match ($this) {
            self::HOKKAIDO => "北海道",
            self::TOHOKU   => "東北",
            self::KANTO    => "関東",
            self::CHUBU    => "中部",
            self::KINKI    => "近畿",
            self::CHUGOKU  => "中国",
            self::SHIKOKU  => "四国",
            self::KYUSHU   => "九州",
        };
    }

    public static function fromKanji(string $kanji): static
    {
        return match ($kanji) {
            self::HOKKAIDO->kanji() => self::HOKKAIDO,
            self::TOHOKU->kanji()   => self::TOHOKU,
            self::KANTO->kanji()    => self::KANTO,
            self::CHUBU->kanji()    => self::CHUBU,
            self::KINKI->kanji()    => self::KINKI,
            self::CHUGOKU->kanji()  => self::CHUGOKU,
            self::SHIKOKU->kanji()  => self::SHIKOKU,
            self::KYUSHU->kanji()   => self::KYUSHU,

            default => throw new \RuntimeException("Invalid kanji region: {$kanji}"),
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
}
