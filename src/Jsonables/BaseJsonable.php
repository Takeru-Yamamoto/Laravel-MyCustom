<?php

namespace MyCustom\Jsonables;

use Carbon\Carbon;

abstract class BaseJsonable implements \JsonSerializable
{
    /**
     * jsonSerialize時にnullのプロパティを含めるかどうか
     * 
     * @var bool $isPropertyNullable
     */
    protected bool $isPropertyNullable = true;


    /**
     * json_encode()でJSONにシリアライズするデータを定義する
     */
    public function jsonSerialize(): mixed
    {
        return $this->convertProperties($this);
    }


    /**
     * Propertyに含まれる特定のオブジェクトを変換する
     */
    private function convertProperties(array|object $haystack): array|\stdClass
    {
        $isArrayHaystack = is_array($haystack);

        $result    = $isArrayHaystack ? [] : new \stdClass;

        $valiables = $isArrayHaystack ? $haystack : get_object_vars($haystack);

        foreach ($valiables as $key => $value) {
            if (!$this->isPropertyNullable && is_null($value)) continue;

            if ($isArrayHaystack) {
                $result[$key] = match (true) {
                    $value instanceof Carbon              => $value->toDateTimeString(),
                    is_array($value) || is_object($value) => $this->convertProperties($value),

                    default => $value,
                };
            } else {
                $result->$key = match (true) {
                    $value instanceof Carbon              => $value->toDateTimeString(),
                    is_array($value) || is_object($value) => $this->convertProperties($value),

                    default => $value,
                };
            }
        }

        return $result;
    }

    public function __toString()
    {
        return jsonEncode($this);
    }
}
