<?php

namespace MyCustom\Utils\Http;

use MyCustom\Jsonables\BaseJsonable;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

final class HttpResponseUtil extends BaseJsonable implements \JsonSerializable
{
    public readonly Response $response;

    function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function jsonSerialize(): array
    {
        return [
            "isSuccess"       => $this->response->successful(),
            "statusCode"      => $this->response->status(),
            "responseHeaders" => $this->response->headers(),
            "responseBody"    => $this->response->json(),
            "responseReason"  => $this->response->reason(),
        ];
    }

    public function isSuccess(): bool
    {
        return $this->response->successful();
    }
    public function statusCode(): int
    {
        return $this->response->status();
    }
    public function headers(): array
    {
        return $this->response->headers();
    }
    public function body(): mixed
    {
        return $this->response->json();
    }
    public function bodyAsString(): string
    {
        return $this->response->body();
    }
    public function bodyAsObject(): mixed
    {
        return $this->response->object();
    }
    public function bodyAsCollection(): Collection
    {
        return $this->response->collect();
    }
    public function reason(): string
    {
        return $this->response->reason();
    }
}
