<?php

namespace MyCustom\Http\Responses;

use MyCustom\Jsonables\BaseJsonable;

use Illuminate\Support\Collection;

abstract class BaseResponse extends BaseJsonable
{
    final public function toJson(): string
    {
        return jsonEncode($this);
    }

    final public function arrayMap(Collection|array $entities, callable $callback): array
    {
        if (!is_array($entities)) $entities = $entities->toArray();

        return array_map($callback, $entities);
    }
}
