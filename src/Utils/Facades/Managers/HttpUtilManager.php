<?php

namespace MyCustom\Utils\Facades\Managers;

use MyCustom\Utils\Http\HttpRequestUtil;
use MyCustom\Utils\Http\HttpResponseUtil;

use MyCustom\Utils\Http\Enums\MethodEnum;

class HttpUtilManager
{
    public function make(MethodEnum $method, string $url, array $params = []): HttpRequestUtil
    {
        return new HttpRequestUtil($method, $url, $params);
    }

    public function get(string $url, array $params = []): HttpRequestUtil
    {
        return $this->make(MethodEnum::GET, $url, $params);
    }

    public function post(string $url, array $params = []): HttpRequestUtil
    {
        return $this->make(MethodEnum::POST, $url, $params);
    }

    public function put(string $url, array $params = []): HttpRequestUtil
    {
        return $this->make(MethodEnum::PUT, $url, $params);
    }

    public function delete(string $url, array $params = []): HttpRequestUtil
    {
        return $this->make(MethodEnum::DELETE, $url, $params);
    }

    public function head(string $url, array $params = []): HttpRequestUtil
    {
        return $this->make(MethodEnum::HEAD, $url, $params);
    }

    public function patch(string $url, array $params = []): HttpRequestUtil
    {
        return $this->make(MethodEnum::PATCH, $url, $params);
    }


    public function getResponse(string $url, array $params = []): HttpResponseUtil
    {
        return $this->get($url, $params)->send();
    }

    public function postResponse(string $url, array $params = []): HttpResponseUtil
    {
        return $this->post($url, $params)->send();
    }

    public function putResponse(string $url, array $params = []): HttpResponseUtil
    {
        return $this->put($url, $params)->send();
    }

    public function deleteResponse(string $url, array $params = []): HttpResponseUtil
    {
        return $this->delete($url, $params)->send();
    }

    public function headResponse(string $url, array $params = []): HttpResponseUtil
    {
        return $this->head($url, $params)->send();
    }

    public function patchResponse(string $url, array $params = []): HttpResponseUtil
    {
        return $this->patch($url, $params)->send();
    }
}
