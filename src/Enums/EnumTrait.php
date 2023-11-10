<?php

namespace MyCustom\Enums;

trait EnumTrait
{
    /**
     * json_encode()でJSONにシリアライズするデータを定義する
     */
    public function jsonSerialize(): mixed
    {
        return $this->value;
    }

    /**
     * Enumのcasesの逆順配列を返す
     */
    final public static function casesReverse(): array
    {
        return array_reverse(self::cases());
    }


    /**
     * Enumのnamesを返す
     */
    final public static function names(): array
    {
        if (!enum_exists(self::class)) return [];

        return array_column(self::cases(), "name");
    }


    /**
     * Enumのnamesの逆順配列を返す
     */
    final public static function namesReverse(): array
    {
        return array_reverse(self::names());
    }


    /**
     * Enumのvaluesを返す
     */
    final public static function values(): array
    {
        if (!enum_exists(self::class)) return [];

        return array_column(self::cases(), "value");
    }


    /**
     * Enumのvaluesの逆順配列を返す
     */
    final public static function valuesReverse(): array
    {
        return array_reverse(self::values());
    }


    /**
     * $nameを元にEnumに変換する
     */
    final public static function fromName(int|string $name): static
    {
        if (enum_exists(self::class)) {
            foreach (self::cases() as $case) {
                if ($name === $case->name) return $case;
            }
        }

        throw new \ValueError("$name is not a valid backing name for enum " . self::class);
    }


    /**
     * $nameを元にEnumに変換する
     * 該当するnameが存在しない場合はnullを返す
     */
    final public static function tryFromName(int|string $name): ?static
    {
        try {
            return self::fromName($name);
        } catch (\ValueError $error) {
            return null;
        }
    }
}
