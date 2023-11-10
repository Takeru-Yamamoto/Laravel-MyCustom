<?php

namespace MyCustom\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use MyCustom\Exceptions\SystemAlert;

use MyCustom\Utils\Facades\Logging;

final class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        "current_password",
        "password",
        "password_confirmation",
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            Logging::infoLog("Exception Caught");

            $loggingUtil = Logging::error();

            $loggingUtil->addDivider();
            $loggingUtil->add("EXCEPTION CAUGHT");
            $loggingUtil->addEmpty();

            $loggingUtil->add("Exception Class", className($e));
            $loggingUtil->add("Exception Message", $e->getMessage());
            $loggingUtil->add("Exception Code", $e->getCode());
            $loggingUtil->add("Exception File", $e->getFile());
            $loggingUtil->add("Exception Line", $e->getLine());
            $loggingUtil->add("Exception Trace");

            $traces = explode(PHP_EOL, $e->getTraceAsString());

            foreach ($traces as $trace) {
                $loggingUtil->add($trace);
            }

            $loggingUtil->addEmpty();

            if (config("mycustom.system_alert.is_send")) {
                if (empty(config("mycustom.system_alert.to.address")) || empty(config("mycustom.system_alert.from.address")) || empty(config("mycustom.system_alert.from.name"))) {
                    $loggingUtil->addDivider();
                    $loggingUtil->add("SYSTEM ALERT CANNOT SEND");
                    $loggingUtil->add("Prease check .env and set about System Alert if you want to receive");
                    $loggingUtil->addDivider();
                } else {
                    foreach (config("mycustom.system_alert.to.address") as $address) {
                        (new SystemAlert($e, $address))->sending();
                    }
                }
            }

            $loggingUtil->addEmpty();
            $loggingUtil->addDivider();
            $loggingUtil->logging();

            return false;
        });
    }
}
