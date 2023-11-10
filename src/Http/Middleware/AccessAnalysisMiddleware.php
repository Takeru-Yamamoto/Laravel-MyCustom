<?php

namespace MyCustom\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

use MyCustom\Utils\Facades\Logging;

final class AccessAnalysisMiddleware
{
    public bool $isLogging;

    public float $start;
    public float $stop;

    function __construct()
    {
        $this->isLogging = config("mycustom.logging_request_url")
            || config("mycustom.logging_request_http_method")
            || config("mycustom.logging_request_user_agent")
            || config("mycustom.logging_request_ip_address")
            || config("mycustom.logging_response_status")
            || config("mycustom.logging_execution_time")
            || config("mycustom.logging_memory_peak_usage");

        if (str_contains(request()->getRequestUri(), "_debugbar")) $this->isLogging = false;
    }


    /**
     * applicationに対するすべてのリクエストをログに残すmiddleware
     * 
     * configの各項目のboolを用いて、どの項目に関するログを残すかを決定する
     *
     * @param Request $request
     * @param \Closure $next
     */
    public function handle(Request $request, \Closure $next): SymfonyResponse
    {
        if (!$this->isLogging) return $next($request);

        $loggingUtil = Logging::info();

        $loggingUtil->setOutputDirectory("access");

        $loggingUtil->addDivider();
        $loggingUtil->add("ACCESS ANALYSIS START");
        $loggingUtil->addEmpty();

        $loggingUtil->logging();

        $this->start = microtime(true);

        return $next($request);
    }

    /**
     * applicationに対するすべてのリクエストが終了した後に呼び出される
     * 
     * configの各項目のboolを用いて、どの項目に関するログを残すかを決定する
     *
     * @param Request $request
     * @param IlluminateResponse|RedirectResponse|JsonResponse $response
     * @return void
     */
    public function terminate(Request $request, IlluminateResponse|RedirectResponse|JsonResponse $response): void
    {
        if (!$this->isLogging) return;

        $loggingUtil = Logging::info();

        $loggingUtil->setOutputDirectory("access");

        $this->stop = microtime(true);

        $loggingUtil->addEmpty();

        if (config("mycustom.logging_request_url")) $loggingUtil->add("Request URL", e($request->getRequestUri()));
        if (config("mycustom.logging_request_http_method")) $loggingUtil->add("Request HTTP Method", $request->method());
        if (config("mycustom.logging_request_user_agent")) $loggingUtil->add("Request User Agent", $request->userAgent());
        if (config("mycustom.logging_request_ip_address")) $loggingUtil->add("Request IP Address", $request->ip());

        if (config("mycustom.logging_response_status")) $loggingUtil->add("Response Status", $response->status() . ": " . $response->statusText());

        if (config("mycustom.logging_execution_time")) $loggingUtil->add("Execution Time", (($this->stop - $this->start) * pow(10, 3)) . "ms");
        if (config("mycustom.logging_memory_peak_usage")) $loggingUtil->add("Memory Peak Usage", (memory_get_peak_usage() / (1024 * 1024)) . " MB (" . memory_get_peak_usage() . " byte)");

        $loggingUtil->addDivider();

        $loggingUtil->logging();
    }
}
