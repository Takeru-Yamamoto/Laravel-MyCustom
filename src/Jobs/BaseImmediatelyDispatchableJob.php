<?php

namespace MyCustom\Jobs;

use MyCustom\Jobs\BaseJob;

use MyCustom\Utils\Facades\Logging;

use Illuminate\Bus\Dispatcher;
use Symfony\Component\Process\Process;

abstract class BaseImmediatelyDispatchableJob extends BaseJob
{
    public static function dispatchImmediately(...$arguments): void
    {
        /* job dispatching */
        $isProcessing = self::isProcessing();

        static::createJobQueue(...$arguments);

        if ($isProcessing) return;

        /* job processing */
        static::launchWorker();
    }

    public static function createJobQueue(...$arguments): void
    {
        $job = new static(...$arguments);

        $queueName = $job::queueName();

        $job->onConnection(static::connection())->onQueue($queueName);

        app(Dispatcher::class)->dispatch($job);

        Logging::infoLog("create job queue: {$queueName}");
    }

    public static function launchWorker(int $timeout = 3600): void
    {
        $executeCommand = "php " . base_path("artisan") . " queue:work --stop-when-empty --queue=" . static::queueName() . " --timeout=" . $timeout . " > /dev/null &";

        exec($executeCommand, $output, $resultCode);

        $encodedOutput = jsonEncode($output);

        $result = Process::$exitCodes[$resultCode] ?? null;

        match (true) {
            is_null($result)     => throw new \RuntimeException("Failed to execute command: {$executeCommand} output: {$encodedOutput} resultCode: {$resultCode}"),
            $resultCode !== 0    => throw new \RuntimeException("Failed to execute command: {$executeCommand} output: {$encodedOutput} resultCode: {$resultCode} result: {$result}"),

            default              => Logging::infoLog("launch worker: {$executeCommand} output: {$encodedOutput} resultCode: {$resultCode} result: {$result}"),
        };
    }
}
