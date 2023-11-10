<?php

namespace MyCustom;

use Illuminate\Support\ServiceProvider as Provider;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use MyCustom\Utils\Facades\Date;
use MyCustom\Utils\Facades\Logging;

class LoggingSqlServiceProvider extends Provider
{
    public function register(): void
    {
        DB::listen(function ($query): void {
            if (!config('mycustom.logging_sql', false)) return;

            $sql = $query->sql;

            foreach ($query->bindings as $binding) {
                $bindingText = match (true) {
                    is_string($binding)                    => "'" . $binding . "'",
                    is_int($binding), is_float($binding)   => strval($binding),
                    is_null($binding)                      => "null",
                    is_bool($binding) && $binding          => "1",
                    is_bool($binding) && !$binding         => "0",
                    $binding instanceof Carbon             => "'" . $binding->toDateTimeString() . "'",
                    $binding instanceof \DateTime          => "'" . $binding->format(Date::FORMAT_DATETIME) . "'",

                    default                                => $binding
                };

                $sql = preg_replace('/\\?/', $bindingText, $sql, 1);
            }

            Logging::infoLog('SQL: "' . $sql . ';", time: ' . $query->time . " ms");
        });
    }
}
