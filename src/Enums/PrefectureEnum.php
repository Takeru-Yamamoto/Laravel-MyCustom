<?php

namespace MyCustom\Enums;

use MyCustom\Enums\EnumTrait;

use MyCustom\Enums\RegionEnum;

enum PrefectureEnum: string
{
    case HOKKAIDO   = "hokkaido";
    case AOMORI     = "aomori";
    case IWATE      = "iwate";
    case MIYAGI     = "miyagi";
    case AKITA      = "akita";
    case YAMAGATA   = "yamagata";
    case FUKUSHIMA  = "fukushima";
    case IBARAKI    = "ibaraki";
    case TOCHIGI    = "tochigi";
    case GUNMA      = "gunma";
    case SAITAMA    = "saitama";
    case CHIBA      = "chiba";
    case TOKYO      = "tokyo";
    case KANAGAWA   = "kanagawa";
    case NIIGATA    = "niigata";
    case TOYAMA     = "toyama";
    case ISHIKAWA   = "ishikawa";
    case FUKUI      = "fukui";
    case YAMANASHI  = "yamanashi";
    case NAGANO     = "nagano";
    case GIFU       = "gifu";
    case SHIZUOKA   = "shizuoka";
    case AICHI      = "aichi";
    case MIE        = "mie";
    case SHIGA      = "shiga";
    case KYOTO      = "kyoto";
    case OSAKA      = "osaka";
    case HYOGO      = "hyogo";
    case NARA       = "nara";
    case WAKAYAMA   = "wakayama";
    case TOTTORI    = "tottori";
    case SHIMANE    = "shimane";
    case OKAYAMA    = "okayama";
    case HIROSHIMA  = "hiroshima";
    case YAMAGUCHI  = "yamaguchi";
    case TOKUSHIMA  = "tokushima";
    case KAGAWA     = "kagawa";
    case EHIME      = "ehime";
    case KOCHI      = "kochi";
    case FUKUOKA    = "fukuoka";
    case SAGA       = "saga";
    case NAGASAKI   = "nagasaki";
    case KUMAMOTO   = "kumamoto";
    case OITA       = "oita";
    case MIYAZAKI   = "miyazaki";
    case KAGOSHIMA  = "kagoshima";
    case OKINAWA    = "okinawa";

    use EnumTrait;

    /* Upper Case */
    public function upperCase(): string
    {
        return ucfirst($this->value);
    }

    public static function fromUpperCase(string $upperCase): static
    {
        return match ($upperCase) {
            self::HOKKAIDO->upperCase()  => self::HOKKAIDO,
            self::AOMORI->upperCase()    => self::AOMORI,
            self::IWATE->upperCase()     => self::IWATE,
            self::MIYAGI->upperCase()    => self::MIYAGI,
            self::AKITA->upperCase()     => self::AKITA,
            self::YAMAGATA->upperCase()  => self::YAMAGATA,
            self::FUKUSHIMA->upperCase() => self::FUKUSHIMA,
            self::IBARAKI->upperCase()   => self::IBARAKI,
            self::TOCHIGI->upperCase()   => self::TOCHIGI,
            self::GUNMA->upperCase()     => self::GUNMA,
            self::SAITAMA->upperCase()   => self::SAITAMA,
            self::CHIBA->upperCase()     => self::CHIBA,
            self::TOKYO->upperCase()     => self::TOKYO,
            self::KANAGAWA->upperCase()  => self::KANAGAWA,
            self::NIIGATA->upperCase()   => self::NIIGATA,
            self::TOYAMA->upperCase()    => self::TOYAMA,
            self::ISHIKAWA->upperCase()  => self::ISHIKAWA,
            self::FUKUI->upperCase()     => self::FUKUI,
            self::YAMANASHI->upperCase() => self::YAMANASHI,
            self::NAGANO->upperCase()    => self::NAGANO,
            self::GIFU->upperCase()      => self::GIFU,
            self::SHIZUOKA->upperCase()  => self::SHIZUOKA,
            self::AICHI->upperCase()     => self::AICHI,
            self::MIE->upperCase()       => self::MIE,
            self::SHIGA->upperCase()     => self::SHIGA,
            self::KYOTO->upperCase()     => self::KYOTO,
            self::OSAKA->upperCase()     => self::OSAKA,
            self::HYOGO->upperCase()     => self::HYOGO,
            self::NARA->upperCase()      => self::NARA,
            self::WAKAYAMA->upperCase()  => self::WAKAYAMA,
            self::TOTTORI->upperCase()   => self::TOTTORI,
            self::SHIMANE->upperCase()   => self::SHIMANE,
            self::OKAYAMA->upperCase()   => self::OKAYAMA,
            self::HIROSHIMA->upperCase() => self::HIROSHIMA,
            self::YAMAGUCHI->upperCase() => self::YAMAGUCHI,
            self::TOKUSHIMA->upperCase() => self::TOKUSHIMA,
            self::KAGAWA->upperCase()    => self::KAGAWA,
            self::EHIME->upperCase()     => self::EHIME,
            self::KOCHI->upperCase()     => self::KOCHI,
            self::FUKUOKA->upperCase()   => self::FUKUOKA,
            self::SAGA->upperCase()      => self::SAGA,
            self::NAGASAKI->upperCase()  => self::NAGASAKI,
            self::KUMAMOTO->upperCase()  => self::KUMAMOTO,
            self::OITA->upperCase()      => self::OITA,
            self::MIYAZAKI->upperCase()  => self::MIYAZAKI,
            self::KAGOSHIMA->upperCase() => self::KAGOSHIMA,
            self::OKINAWA->upperCase()   => self::OKINAWA,

            default => throw new \RuntimeException("Invalid upper case prefecture: {$upperCase}"),
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


    /* Number */
    public function number(): int
    {
        return match ($this) {
            self::HOKKAIDO  => 1,
            self::AOMORI    => 2,
            self::IWATE     => 3,
            self::MIYAGI    => 4,
            self::AKITA     => 5,
            self::YAMAGATA  => 6,
            self::FUKUSHIMA => 7,
            self::IBARAKI   => 8,
            self::TOCHIGI   => 9,
            self::GUNMA     => 10,
            self::SAITAMA   => 11,
            self::CHIBA     => 12,
            self::TOKYO     => 13,
            self::KANAGAWA  => 14,
            self::NIIGATA   => 15,
            self::TOYAMA    => 16,
            self::ISHIKAWA  => 17,
            self::FUKUI     => 18,
            self::YAMANASHI => 19,
            self::NAGANO    => 20,
            self::GIFU      => 21,
            self::SHIZUOKA  => 22,
            self::AICHI     => 23,
            self::MIE       => 24,
            self::SHIGA     => 25,
            self::KYOTO     => 26,
            self::OSAKA     => 27,
            self::HYOGO     => 28,
            self::NARA      => 29,
            self::WAKAYAMA  => 30,
            self::TOTTORI   => 31,
            self::SHIMANE   => 32,
            self::OKAYAMA   => 33,
            self::HIROSHIMA => 34,
            self::YAMAGUCHI => 35,
            self::TOKUSHIMA => 36,
            self::KAGAWA    => 37,
            self::EHIME     => 38,
            self::KOCHI     => 39,
            self::FUKUOKA   => 40,
            self::SAGA      => 41,
            self::NAGASAKI  => 42,
            self::KUMAMOTO  => 43,
            self::OITA      => 44,
            self::MIYAZAKI  => 45,
            self::KAGOSHIMA => 46,
            self::OKINAWA   => 47,
        };
    }

    public static function fromNumber(int $number): static
    {
        return match ($number) {
            self::HOKKAIDO->number()  => self::HOKKAIDO,
            self::AOMORI->number()    => self::AOMORI,
            self::IWATE->number()     => self::IWATE,
            self::MIYAGI->number()    => self::MIYAGI,
            self::AKITA->number()     => self::AKITA,
            self::YAMAGATA->number()  => self::YAMAGATA,
            self::FUKUSHIMA->number() => self::FUKUSHIMA,
            self::IBARAKI->number()   => self::IBARAKI,
            self::TOCHIGI->number()   => self::TOCHIGI,
            self::GUNMA->number()     => self::GUNMA,
            self::SAITAMA->number()   => self::SAITAMA,
            self::CHIBA->number()     => self::CHIBA,
            self::TOKYO->number()     => self::TOKYO,
            self::KANAGAWA->number()  => self::KANAGAWA,
            self::NIIGATA->number()   => self::NIIGATA,
            self::TOYAMA->number()    => self::TOYAMA,
            self::ISHIKAWA->number()  => self::ISHIKAWA,
            self::FUKUI->number()     => self::FUKUI,
            self::YAMANASHI->number() => self::YAMANASHI,
            self::NAGANO->number()    => self::NAGANO,
            self::GIFU->number()      => self::GIFU,
            self::SHIZUOKA->number()  => self::SHIZUOKA,
            self::AICHI->number()     => self::AICHI,
            self::MIE->number()       => self::MIE,
            self::SHIGA->number()     => self::SHIGA,
            self::KYOTO->number()     => self::KYOTO,
            self::OSAKA->number()     => self::OSAKA,
            self::HYOGO->number()     => self::HYOGO,
            self::NARA->number()      => self::NARA,
            self::WAKAYAMA->number()  => self::WAKAYAMA,
            self::TOTTORI->number()   => self::TOTTORI,
            self::SHIMANE->number()   => self::SHIMANE,
            self::OKAYAMA->number()   => self::OKAYAMA,
            self::HIROSHIMA->number() => self::HIROSHIMA,
            self::YAMAGUCHI->number() => self::YAMAGUCHI,
            self::TOKUSHIMA->number() => self::TOKUSHIMA,
            self::KAGAWA->number()    => self::KAGAWA,
            self::EHIME->number()     => self::EHIME,
            self::KOCHI->number()     => self::KOCHI,
            self::FUKUOKA->number()   => self::FUKUOKA,
            self::SAGA->number()      => self::SAGA,
            self::NAGASAKI->number()  => self::NAGASAKI,
            self::KUMAMOTO->number()  => self::KUMAMOTO,
            self::OITA->number()      => self::OITA,
            self::MIYAZAKI->number()  => self::MIYAZAKI,
            self::KAGOSHIMA->number() => self::KAGOSHIMA,
            self::OKINAWA->number()   => self::OKINAWA,

            default => throw new \RuntimeException("Invalid number prefecture: {$number}"),
        };
    }

    public static function tryFromNumber(int $number): ?static
    {
        try {
            return self::fromNumber($number);
        } catch (\Throwable) {
            return null;
        }
    }


    /* Kanji */
    public function kanji(): string
    {
        return match ($this) {
            self::HOKKAIDO   => "北海",
            self::AOMORI     => "青森",
            self::IWATE      => "岩手",
            self::MIYAGI     => "宮城",
            self::AKITA      => "秋田",
            self::YAMAGATA   => "山形",
            self::FUKUSHIMA  => "福島",
            self::IBARAKI    => "茨城",
            self::TOCHIGI    => "栃木",
            self::GUNMA      => "群馬",
            self::SAITAMA    => "埼玉",
            self::CHIBA      => "千葉",
            self::TOKYO      => "東京",
            self::KANAGAWA   => "神奈川",
            self::NIIGATA    => "新潟",
            self::TOYAMA     => "富山",
            self::ISHIKAWA   => "石川",
            self::FUKUI      => "福井",
            self::YAMANASHI  => "山梨",
            self::NAGANO     => "長野",
            self::GIFU       => "岐阜",
            self::SHIZUOKA   => "静岡",
            self::AICHI      => "愛知",
            self::MIE        => "三重",
            self::SHIGA      => "滋賀",
            self::KYOTO      => "京都",
            self::OSAKA      => "大阪",
            self::HYOGO      => "兵庫",
            self::NARA       => "奈良",
            self::WAKAYAMA   => "和歌山",
            self::TOTTORI    => "鳥取",
            self::SHIMANE    => "島根",
            self::OKAYAMA    => "岡山",
            self::HIROSHIMA  => "広島",
            self::YAMAGUCHI  => "山口",
            self::TOKUSHIMA  => "徳島",
            self::KAGAWA     => "香川",
            self::EHIME      => "愛媛",
            self::KOCHI      => "高知",
            self::FUKUOKA    => "福岡",
            self::SAGA       => "佐賀",
            self::NAGASAKI   => "長崎",
            self::KUMAMOTO   => "熊本",
            self::OITA       => "大分",
            self::MIYAZAKI   => "宮崎",
            self::KAGOSHIMA  => "鹿児島",
            self::OKINAWA    => "沖縄",
        };
    }

    public static function fromKanji(string $kanji): static
    {
        return match ($kanji) {
            self::HOKKAIDO->kanji()  => self::HOKKAIDO,
            self::AOMORI->kanji()    => self::AOMORI,
            self::IWATE->kanji()     => self::IWATE,
            self::MIYAGI->kanji()    => self::MIYAGI,
            self::AKITA->kanji()     => self::AKITA,
            self::YAMAGATA->kanji()  => self::YAMAGATA,
            self::FUKUSHIMA->kanji() => self::FUKUSHIMA,
            self::IBARAKI->kanji()   => self::IBARAKI,
            self::TOCHIGI->kanji()   => self::TOCHIGI,
            self::GUNMA->kanji()     => self::GUNMA,
            self::SAITAMA->kanji()   => self::SAITAMA,
            self::CHIBA->kanji()     => self::CHIBA,
            self::TOKYO->kanji()     => self::TOKYO,
            self::KANAGAWA->kanji()  => self::KANAGAWA,
            self::NIIGATA->kanji()   => self::NIIGATA,
            self::TOYAMA->kanji()    => self::TOYAMA,
            self::ISHIKAWA->kanji()  => self::ISHIKAWA,
            self::FUKUI->kanji()     => self::FUKUI,
            self::YAMANASHI->kanji() => self::YAMANASHI,
            self::NAGANO->kanji()    => self::NAGANO,
            self::GIFU->kanji()      => self::GIFU,
            self::SHIZUOKA->kanji()  => self::SHIZUOKA,
            self::AICHI->kanji()     => self::AICHI,
            self::MIE->kanji()       => self::MIE,
            self::SHIGA->kanji()     => self::SHIGA,
            self::KYOTO->kanji()     => self::KYOTO,
            self::OSAKA->kanji()     => self::OSAKA,
            self::HYOGO->kanji()     => self::HYOGO,
            self::NARA->kanji()      => self::NARA,
            self::WAKAYAMA->kanji()  => self::WAKAYAMA,
            self::TOTTORI->kanji()   => self::TOTTORI,
            self::SHIMANE->kanji()   => self::SHIMANE,
            self::OKAYAMA->kanji()   => self::OKAYAMA,
            self::HIROSHIMA->kanji() => self::HIROSHIMA,
            self::YAMAGUCHI->kanji() => self::YAMAGUCHI,
            self::TOKUSHIMA->kanji() => self::TOKUSHIMA,
            self::KAGAWA->kanji()    => self::KAGAWA,
            self::EHIME->kanji()     => self::EHIME,
            self::KOCHI->kanji()     => self::KOCHI,
            self::FUKUOKA->kanji()   => self::FUKUOKA,
            self::SAGA->kanji()      => self::SAGA,
            self::NAGASAKI->kanji()  => self::NAGASAKI,
            self::KUMAMOTO->kanji()  => self::KUMAMOTO,
            self::OITA->kanji()      => self::OITA,
            self::MIYAZAKI->kanji()  => self::MIYAZAKI,
            self::KAGOSHIMA->kanji() => self::KAGOSHIMA,
            self::OKINAWA->kanji()   => self::OKINAWA,

            default => throw new \RuntimeException("Invalid kanji prefecture: {$kanji}"),
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
            self::HOKKAIDO   => "北海道",
            self::AOMORI     => "青森県",
            self::IWATE      => "岩手県",
            self::MIYAGI     => "宮城県",
            self::AKITA      => "秋田県",
            self::YAMAGATA   => "山形県",
            self::FUKUSHIMA  => "福島県",
            self::IBARAKI    => "茨城県",
            self::TOCHIGI    => "栃木県",
            self::GUNMA      => "群馬県",
            self::SAITAMA    => "埼玉県",
            self::CHIBA      => "千葉県",
            self::TOKYO      => "東京都",
            self::KANAGAWA   => "神奈川県",
            self::NIIGATA    => "新潟県",
            self::TOYAMA     => "富山県",
            self::ISHIKAWA   => "石川県",
            self::FUKUI      => "福井県",
            self::YAMANASHI  => "山梨県",
            self::NAGANO     => "長野県",
            self::GIFU       => "岐阜県",
            self::SHIZUOKA   => "静岡県",
            self::AICHI      => "愛知県",
            self::MIE        => "三重県",
            self::SHIGA      => "滋賀県",
            self::KYOTO      => "京都府",
            self::OSAKA      => "大阪府",
            self::HYOGO      => "兵庫県",
            self::NARA       => "奈良県",
            self::WAKAYAMA   => "和歌山県",
            self::TOTTORI    => "鳥取県",
            self::SHIMANE    => "島根県",
            self::OKAYAMA    => "岡山県",
            self::HIROSHIMA  => "広島県",
            self::YAMAGUCHI  => "山口県",
            self::TOKUSHIMA  => "徳島県",
            self::KAGAWA     => "香川県",
            self::EHIME      => "愛媛県",
            self::KOCHI      => "高知県",
            self::FUKUOKA    => "福岡県",
            self::SAGA       => "佐賀県",
            self::NAGASAKI   => "長崎県",
            self::KUMAMOTO   => "熊本県",
            self::OITA       => "大分県",
            self::MIYAZAKI   => "宮崎県",
            self::KAGOSHIMA  => "鹿児島県",
            self::OKINAWA    => "沖縄県",
        };
    }

    public static function fromKanjiFull(string $kanjiFull): static
    {
        return match ($kanjiFull) {
            self::HOKKAIDO->kanjiFull()  => self::HOKKAIDO,
            self::AOMORI->kanjiFull()    => self::AOMORI,
            self::IWATE->kanjiFull()     => self::IWATE,
            self::MIYAGI->kanjiFull()    => self::MIYAGI,
            self::AKITA->kanjiFull()     => self::AKITA,
            self::YAMAGATA->kanjiFull()  => self::YAMAGATA,
            self::FUKUSHIMA->kanjiFull() => self::FUKUSHIMA,
            self::IBARAKI->kanjiFull()   => self::IBARAKI,
            self::TOCHIGI->kanjiFull()   => self::TOCHIGI,
            self::GUNMA->kanjiFull()     => self::GUNMA,
            self::SAITAMA->kanjiFull()   => self::SAITAMA,
            self::CHIBA->kanjiFull()     => self::CHIBA,
            self::TOKYO->kanjiFull()     => self::TOKYO,
            self::KANAGAWA->kanjiFull()  => self::KANAGAWA,
            self::NIIGATA->kanjiFull()   => self::NIIGATA,
            self::TOYAMA->kanjiFull()    => self::TOYAMA,
            self::ISHIKAWA->kanjiFull()  => self::ISHIKAWA,
            self::FUKUI->kanjiFull()     => self::FUKUI,
            self::YAMANASHI->kanjiFull() => self::YAMANASHI,
            self::NAGANO->kanjiFull()    => self::NAGANO,
            self::GIFU->kanjiFull()      => self::GIFU,
            self::SHIZUOKA->kanjiFull()  => self::SHIZUOKA,
            self::AICHI->kanjiFull()     => self::AICHI,
            self::MIE->kanjiFull()       => self::MIE,
            self::SHIGA->kanjiFull()     => self::SHIGA,
            self::KYOTO->kanjiFull()     => self::KYOTO,
            self::OSAKA->kanjiFull()     => self::OSAKA,
            self::HYOGO->kanjiFull()     => self::HYOGO,
            self::NARA->kanjiFull()      => self::NARA,
            self::WAKAYAMA->kanjiFull()  => self::WAKAYAMA,
            self::TOTTORI->kanjiFull()   => self::TOTTORI,
            self::SHIMANE->kanjiFull()   => self::SHIMANE,
            self::OKAYAMA->kanjiFull()   => self::OKAYAMA,
            self::HIROSHIMA->kanjiFull() => self::HIROSHIMA,
            self::YAMAGUCHI->kanjiFull() => self::YAMAGUCHI,
            self::TOKUSHIMA->kanjiFull() => self::TOKUSHIMA,
            self::KAGAWA->kanjiFull()    => self::KAGAWA,
            self::EHIME->kanjiFull()     => self::EHIME,
            self::KOCHI->kanjiFull()     => self::KOCHI,
            self::FUKUOKA->kanjiFull()   => self::FUKUOKA,
            self::SAGA->kanjiFull()      => self::SAGA,
            self::NAGASAKI->kanjiFull()  => self::NAGASAKI,
            self::KUMAMOTO->kanjiFull()  => self::KUMAMOTO,
            self::OITA->kanjiFull()      => self::OITA,
            self::MIYAZAKI->kanjiFull()  => self::MIYAZAKI,
            self::KAGOSHIMA->kanjiFull() => self::KAGOSHIMA,
            self::OKINAWA->kanjiFull()   => self::OKINAWA,

            default => throw new \RuntimeException("Invalid kanji full prefecture: {$kanjiFull}"),
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


    /* Region */
    public function region(): RegionEnum
    {
        return match ($this) {
            self::HOKKAIDO                                                                                                                   => RegionEnum::HOKKAIDO,
            self::AOMORI, self::IWATE, self::MIYAGI, self::AKITA, self::YAMAGATA, self::FUKUSHIMA                                            => RegionEnum::TOHOKU,
            self::IBARAKI, self::TOCHIGI, self::GUNMA, self::SAITAMA, self::CHIBA, self::TOKYO, self::KANAGAWA                               => RegionEnum::KANTO,
            self::NIIGATA, self::TOYAMA, self::ISHIKAWA, self::FUKUI, self::YAMANASHI, self::NAGANO, self::GIFU, self::SHIZUOKA, self::AICHI => RegionEnum::CHUBU,
            self::MIE, self::SHIGA, self::KYOTO, self::OSAKA, self::HYOGO, self::NARA, self::WAKAYAMA                                        => RegionEnum::KINKI,
            self::TOTTORI, self::SHIMANE, self::OKAYAMA, self::HIROSHIMA, self::YAMAGUCHI                                                    => RegionEnum::CHUGOKU,
            self::TOKUSHIMA, self::KAGAWA, self::EHIME, self::KOCHI                                                                          => RegionEnum::SHIKOKU,
            self::FUKUOKA, self::SAGA, self::NAGASAKI, self::KUMAMOTO, self::OITA, self::MIYAZAKI, self::KAGOSHIMA, self::OKINAWA            => RegionEnum::KYUSHU,
        };
    }
}
