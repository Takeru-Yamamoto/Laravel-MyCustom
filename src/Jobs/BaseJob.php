<?php

namespace MyCustom\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use MyCustom\Utils\Facades\Logging;

use Illuminate\Support\Facades\DB;

abstract class BaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $queueName = static::queueName();

        try {
            Logging::infoLog("Start Job Process: " . $queueName);

            $this->process();

            Logging::infoLog("Finish Job Process: " . $queueName);
        } catch (\Throwable $e) {
            Logging::infoLog("Exception Caught in Job Process: " . $queueName);

            $this->delete();

            report($e);
        }
    }

    abstract protected function process(): void;

    public static function queueName(): string
    {
        return className(static::class);
    }

    public static function isProcessing(): bool
    {
        if (static::connection() !== "database") return false;

        return DB::table(config("queue.connections.database.table"))->where("queue", static::queueName())->exists();
    }

    public static function connection(): string
    {
        return config("queue.default");
    }

    public static function failedJobTable(): string
    {
        return config("queue.failed.table");
    }
}
