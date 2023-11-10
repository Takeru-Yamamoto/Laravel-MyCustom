<?php

namespace MyCustom\Utils\Redirect;

use MyCustom\Jsonables\BaseJsonable;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\MessageProvider;

final class RedirectUtil extends BaseJsonable
{
    public readonly RedirectResponse $response;

    function __construct(string $url)
    {
        $this->response = redirect($url);
    }

    public function with(string|array $key, mixed $value = null): static
    {
        $this->response->with($key, $value);

        return $this;
    }

    public function withMessage(string $messageKey, string $messageText, string $additionalText = null): static
    {
        $message = is_null($additionalText) ? $messageText : $messageText . PHP_EOL . $additionalText;

        $this->with($messageKey, $message);

        return $this;
    }

    public function successMessage(string $message, string $additionalText = null): static
    {
        return $this->withMessage("success_message", $message, $additionalText);
    }

    public function dangerMessage(string $message, string $additionalText = null): static
    {
        return $this->withMessage("danger_message", $message, $additionalText);
    }

    public function forkMessage(bool $isSuccess, string $message, string $additionalText = null): static
    {
        return $isSuccess ? $this->successMessage($message, $additionalText) : $this->dangerMessage($message, $additionalText);
    }

    public function withInput(array $input = null): static
    {
        $this->response->withInput($input);

        return $this;
    }

    public function withCookies(array $cookies): static
    {
        $this->response->withCookies($cookies);

        return $this;
    }

    public function withErrors(MessageProvider|array|string $provider, string $key = "default"): static
    {
        $this->response->withErrors($provider, $key);

        return $this;
    }
}
