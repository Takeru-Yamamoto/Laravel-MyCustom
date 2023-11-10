<?php

namespace MyCustom\Http\Responses;

use MyCustom\Http\Responses\BaseResponse;

abstract class BaseResultResponse extends BaseResponse
{
    /**
     * json_encode()でJSONにシリアライズするデータを定義する
     */
    public function jsonSerialize(): mixed
    {
        return ["result" => parent::jsonSerialize()];
    }
}
