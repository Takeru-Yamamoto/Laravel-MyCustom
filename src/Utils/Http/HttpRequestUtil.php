<?php

namespace MyCustom\Utils\Http;

use MyCustom\Jsonables\BaseJsonable;

use MyCustom\Utils\Http\HttpResponseUtil;

use MyCustom\Utils\Http\Enums\AuthEnum;
use MyCustom\Utils\Http\Enums\BodyFormatEnum;
use MyCustom\Utils\Http\Enums\RequestHeadersEnum;
use MyCustom\Utils\Http\Enums\MethodEnum;

use MyCustom\Utils\Http\Enums\RequestHeaders\AcceptEnum;
use MyCustom\Utils\Http\Enums\RequestHeaders\TokenTypeEnum;
use MyCustom\Utils\Http\Enums\RequestHeaders\ContentTypeEnum;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

final class HttpRequestUtil extends BaseJsonable
{
    public readonly string $url;
    public readonly array $params;
    public readonly MethodEnum $method;

    /* Auth */
    private ?AuthEnum $auth   = null;
    private ?string $userName = null;
    private ?string $password = null;

    /* Body Format */
    private ?BodyFormatEnum $bodyFormat = null;

    /* Request Headers */
    private ?array $requestHeaders = [];

    /* Timeout */
    private ?int $timeout = null;
    private ?int $connectTimeout = null;

    /* Retry Variables */
    private ?int $retryTimes    = null;
    private ?int $retrySleeps   = null;
    private ?\Closure $retryWhen = null;

    /* .etc Variables */
    private ?int $maxRedirects = null;
    private bool $withoutRedirecting = false;
    private bool $withoutVerifying = false;


    function __construct(MethodEnum $method, string $url, array $params)
    {
        $this->method  = $method;
        $this->url     = $url;
        $this->params  = $params;
    }


    public function send(): HttpResponseUtil
    {
        $request = Http::asJson();

        if ($this->hasAuth()) $request = $this->withAuth($request);

        if ($this->hasBodyFormat()) $request = $this->withBodyFormat($request);

        if ($this->hasRequestHeaders()) $request = $this->withRequestHeaders($request);

        if ($this->hasTimeout()) $request = $this->withTimeout($request);

        if ($this->hasConnectTimeout()) $request = $this->withConnectTimeout($request);

        if ($this->hasRetry()) $request = $this->withRetry($request);

        if ($this->hasMaxRedirects()) $request = $this->withMaxRedirects($request);

        if ($this->isWithoutRedirecting()) $request = $this->withWithoutRedirecting($request);

        if ($this->isWithoutVerifying()) $request = $this->withWithoutVerifying($request);

        $response = match ($this->method) {
            MethodEnum::GET    => $request->get($this->url, $this->params),
            MethodEnum::POST   => $request->post($this->url, $this->params),
            MethodEnum::PUT    => $request->put($this->url, $this->params),
            MethodEnum::DELETE => $request->delete($this->url, $this->params),
            MethodEnum::HEAD   => $request->head($this->url, $this->params),
            MethodEnum::PATCH  => $request->patch($this->url, $this->params),
        };

        return new HttpResponseUtil($response);
    }



    /*------------------------------------------------------------------------------------------------------------------ 
     * Auth
     *------------------------------------------------------------------------------------------------------------------*/

    private function hasAuth(): bool
    {
        return !is_null($this->auth) && !is_null($this->userName) && !is_null($this->password);
    }

    private function withAuth(PendingRequest $request): PendingRequest
    {
        return match ($this->auth) {
            AuthEnum::BASIC  => $request->withBasicAuth($this->userName, $this->password),
            AuthEnum::DIGEST => $request->withDigestAuth($this->userName, $this->password),
        };
    }

    public function basicAuth(string $userName, string $password): static
    {
        $this->auth     = AuthEnum::BASIC;
        $this->userName = $userName;
        $this->password = $password;

        return $this;
    }

    public function digestAuth(string $userName, string $password): static
    {
        $this->auth     = AuthEnum::DIGEST;
        $this->userName = $userName;
        $this->password = $password;

        return $this;
    }



    /*------------------------------------------------------------------------------------------------------------------ 
     * Body Format
     *------------------------------------------------------------------------------------------------------------------*/

    private function hasBodyFormat(): bool
    {
        return !is_null($this->bodyFormat);
    }

    private function withBodyFormat(PendingRequest $request): PendingRequest
    {
        return $request->bodyFormat($this->bodyFormat->value);
    }

    public function bodyFormat(BodyFormatEnum $bodyFormat): static
    {
        $this->bodyFormat = $bodyFormat;

        return $this;
    }

    public function asBody(): static
    {
        return $this->bodyFormat(BodyFormatEnum::BODY);
    }

    public function asJson(): static
    {
        return $this->bodyFormat(BodyFormatEnum::JSON);
    }

    public function asForm(): static
    {
        return $this->bodyFormat(BodyFormatEnum::FORM);
    }

    public function asMultipart(): static
    {
        return $this->bodyFormat(BodyFormatEnum::MULTIPART);
    }



    /*------------------------------------------------------------------------------------------------------------------ 
     * Request Headers
     *------------------------------------------------------------------------------------------------------------------*/

    private function hasRequestHeaders(): bool
    {
        return !empty($this->requestHeaders);
    }

    private function withRequestHeaders(PendingRequest $request): PendingRequest
    {
        return $request->withHeaders($this->requestHeaders);
    }

    public function requestHeaders(array $requestHeaders): static
    {
        $this->requestHeaders = array_merge_recursive($this->requestHeaders, $requestHeaders);

        return $this;
    }

    public function requestHeader(RequestHeadersEnum|string $key, string $value): static
    {
        if($key instanceof RequestHeadersEnum) $key = $key->value;

        return $this->requestHeaders([$key => $value]);
    }


    /* Accept */

    public function accept(AcceptEnum $accept): static
    {
        return $this->requestHeader(RequestHeadersEnum::ACCEPT, $accept->value);
    }

    public function acceptJson(): static
    {
        return $this->accept(AcceptEnum::JSON);
    }

    public function acceptForm(): static
    {
        return $this->accept(AcceptEnum::FORM);
    }

    public function acceptHtml(): static
    {
        return $this->accept(AcceptEnum::HTML);
    }


    /* Token */

    public function token(TokenTypeEnum $tokenType, string $token): static
    {
        return $this->requestHeader(RequestHeadersEnum::AUTHORIZATION, trim($tokenType->value . " " . $token));
    }

    public function bearerToken(string $token): static
    {
        return $this->token(TokenTypeEnum::BEARER, $token);
    }


    /* Content Type */

    public function contentType(ContentTypeEnum $contentType): static
    {
        return $this->requestHeader(RequestHeadersEnum::CONTENT_TYPE, $contentType->value);
    }

    public function contentTypeJson(): static
    {
        return $this->contentType(ContentTypeEnum::JSON);
    }

    public function contentTypeForm(): static
    {
        return $this->contentType(ContentTypeEnum::FORM);
    }

    public function contentTypeHtml(): static
    {
        return $this->contentType(ContentTypeEnum::HTML);
    }



    /*------------------------------------------------------------------------------------------------------------------ 
     * Timeout
     *------------------------------------------------------------------------------------------------------------------*/

    private function hasTimeout(): bool
    {
        return !is_null($this->timeout);
    }

    private function withTimeout(PendingRequest $request): PendingRequest
    {
        return $request->timeout($this->timeout);
    }

    public function timeout(int $seconds = 30): static
    {
        $this->timeout = $seconds;
        return $this;
    }



    /*------------------------------------------------------------------------------------------------------------------ 
     * Connect Timeout
     *------------------------------------------------------------------------------------------------------------------*/

    private function hasConnectTimeout(): bool
    {
        return !is_null($this->connectTimeout);
    }

    private function withConnectTimeout(PendingRequest $request): PendingRequest
    {
        return $request->connectTimeout($this->connectTimeout);
    }

    public function connectTimeout(int $seconds = 10): static
    {
        $this->connectTimeout = $seconds;
        return $this;
    }



    /*------------------------------------------------------------------------------------------------------------------ 
     * Retry
     *------------------------------------------------------------------------------------------------------------------*/

    private function hasRetry(): bool
    {
        return !is_null($this->retryTimes) && !is_null($this->retrySleeps) && !is_null($this->retryWhen);
    }

    private function withRetry(PendingRequest $request): PendingRequest
    {
        return $request->retry($this->retryTimes, $this->retrySleeps, $this->retryWhen);
    }

    public function retry(int $times, int $sleepMilliseconds = 0, ?\Closure $when = null): static
    {
        $this->retryTimes  = $times;
        $this->retrySleeps = $sleepMilliseconds;
        $this->retryWhen   = $when;

        return $this;
    }



    /*------------------------------------------------------------------------------------------------------------------ 
     * Max Redirects
     *------------------------------------------------------------------------------------------------------------------*/

    private function hasMaxRedirects(): bool
    {
        return !is_null($this->maxRedirects);
    }

    private function withMaxRedirects(PendingRequest $request): PendingRequest
    {
        return $request->maxRedirects($this->maxRedirects);
    }

    public function maxRedirects(int $maxRedirects): static
    {
        $this->maxRedirects = $maxRedirects;

        return $this;
    }



    /*------------------------------------------------------------------------------------------------------------------ 
     * Without Redirecting
     *------------------------------------------------------------------------------------------------------------------*/

    private function isWithoutRedirecting(): bool
    {
        return $this->withoutRedirecting;
    }

    private function withWithoutRedirecting(PendingRequest $request): PendingRequest
    {
        return $request->withoutRedirecting();
    }

    public function withoutRedirecting(): static
    {
        $this->withoutRedirecting = true;

        return $this;
    }



    /*------------------------------------------------------------------------------------------------------------------ 
     * Without Verifying
     *------------------------------------------------------------------------------------------------------------------*/

    private function isWithoutVerifying(): bool
    {
        return $this->withoutVerifying;
    }

    private function withWithoutVerifying(PendingRequest $request): PendingRequest
    {
        return $request->withoutVerifying();
    }

    public function withoutVerifying(): static
    {
        $this->withoutVerifying = true;

        return $this;
    }
}
