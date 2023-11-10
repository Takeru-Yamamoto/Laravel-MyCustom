<?php

namespace MyCustom\Utils\Facades\Managers;

use MyCustom\Utils\Logging\LoggingUtil;

use MyCustom\Utils\Logging\Enums\LogLevelEnum;

class LoggingUtilManager
{
    public function make(LogLevelEnum $logLevel): LoggingUtil
    {
        return new LoggingUtil($logLevel);
    }

    public function debug(): LoggingUtil
    {
        return $this->make(LogLevelEnum::DEBUG);
    }

    public function info(): LoggingUtil
    {
        return $this->make(LogLevelEnum::INFO);
    }

    public function notice(): LoggingUtil
    {
        return $this->make(LogLevelEnum::NOTICE);
    }

    public function warning(): LoggingUtil
    {
        return $this->make(LogLevelEnum::WARNING);
    }

    public function error(): LoggingUtil
    {
        return $this->make(LogLevelEnum::ERROR);
    }

    public function critical(): LoggingUtil
    {
        return $this->make(LogLevelEnum::CRITICAL);
    }

    public function alert(): LoggingUtil
    {
        return $this->make(LogLevelEnum::ALERT);
    }

    public function emergency(): LoggingUtil
    {
        return $this->make(LogLevelEnum::EMERGENCY);
    }


    public function debugLog(mixed $message, mixed $value = null): void
    {
        $this->debug()->add($message, $value)->logging();
    }

    public function infoLog(mixed $message, mixed $value = null): void
    {
        $this->info()->add($message, $value)->logging();
    }

    public function noticeLog(mixed $message, mixed $value = null): void
    {
        $this->notice()->add($message, $value)->logging();
    }

    public function warningLog(mixed $message, mixed $value = null): void
    {
        $this->warning()->add($message, $value)->logging();
    }

    public function errorLog(mixed $message, mixed $value = null): void
    {
        $this->error()->add($message, $value)->logging();
    }

    public function criticalLog(mixed $message, mixed $value = null): void
    {
        $this->critical()->add($message, $value)->logging();
    }

    public function alertLog(mixed $message, mixed $value = null): void
    {
        $this->alert()->add($message, $value)->logging();
    }

    public function emergencyLog(mixed $message, mixed $value = null): void
    {
        $this->emergency()->add($message, $value)->logging();
    }
}
