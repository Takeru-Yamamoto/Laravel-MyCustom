<?php

namespace MyCustom\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use MyCustom\Models\Enums\MessageEnum;

use MyCustom\Utils\Facades\Logging;

/**
 * Modelで使用するtrait
 */
trait BaseModel
{
    /**
     * データベース処理をtransactionメソッドでwrap
     *
     * @param string $message
     */
    final public function safe(string $message, \Closure $transactional, bool $isThrowable): ?string
    {
        if ($isThrowable) {
            $this->transaction($message, $transactional);

            return null;
        }

        try {
            $this->transaction($message, $transactional);

            return null;
        } catch (\Throwable $Throwable) {
            return $Throwable->getMessage();
        }
    }

    /**
     * ログに残すメッセージを作成する
     *
     * @param MessageEnum $message
     */
    final public function createMessage(MessageEnum $message): string
    {
        $className = className($this);
        $backtrace = debug_backtrace();
        $targetBacktrace = isset($backtrace[1]) ? $backtrace[1] : null;

        if (is_null($targetBacktrace) || !isset($targetBacktrace["file"]) || !isset($targetBacktrace["line"])) return $className . " " . $message->value;

        $service = explode(DIRECTORY_SEPARATOR, $targetBacktrace["file"]);
        $serviceClassName = str_replace(".php", "", end($service));
        $line = $targetBacktrace["line"];

        return $className . " " . $message->value . " in " . $serviceClassName . ": " . $line;
    }

    /**
     * transaction を使用した安全な保存
     */
    final public function safeCreate(bool $isThrowable = false): ?string
    {
        return $this->safe($this->createMessage(MessageEnum::CREATE), function () {
            $this->save();
        }, $isThrowable);
    }

    /**
     * transaction を使用した安全な更新
     */
    final public function safeUpdate(bool $isThrowable = false): ?string
    {
        return $this->safe($this->createMessage(MessageEnum::UPDATE), function () {
            $this->save();
        }, $isThrowable);
    }

    /**
     * transaction を使用した安全な削除
     */
    final public function safeDelete(bool $isThrowable = false): ?string
    {
        return $this->safe($this->createMessage(MessageEnum::DELETE), function () {
            $this->delete();
        }, $isThrowable);
    }

    /**
     * transaction を使用した安全な復活
     */
    final public function safeRestore(bool $isThrowable = false): ?string
    {
        return $this->safe($this->createMessage(MessageEnum::RESTORE), function () {
            $this->restore();
        }, $isThrowable);
    }

    /**
     * is_validカラムが存在する場合 isValid に置き換え保存する
     *
     * @param integer $isValid
     */
    final public function changeIsValid(int $isValid, bool $isThrowable = false): ?string
    {
        if (!isset($this->is_valid)) return null;

        $this->is_valid = $isValid;

        return $this->safe($this->createMessage(MessageEnum::CHANGE_IS_VALID), function () {
            $this->save();
        }, $isThrowable);
    }

    /**
     * レコードが有効か無効か
     * is_validカラムが存在しない場合はfalse
     */
    final public function isValid(): bool
    {
        return isset($this->is_valid) ? boolval($this->is_valid) : false;
    }

    /**
     * レコードの有効期限が切れているか
     * expiration_dateカラムが存在しない場合はfalse
     */
    final public function expirationDateOver(): bool
    {
        return isset($this->expiration_date) ? (new Carbon($this->expiration_date))->lte(Carbon::now()) : false;
    }

    /**
     * データベースへの変更に失敗した場合、自動的に元の状態に戻す
     */
    final public function transaction(string $description, \Closure $transactional): void
    {
        $exception = null;
        $isLogging = config("mycustom.logging_transaction", false);

        $loggingUtil = Logging::info();

        $loggingUtil->addEmphasis("TRANSACTION START");

        DB::beginTransaction();

        try {
            $transactional();

            DB::commit();

            $loggingUtil->add("TRANSACTION", "success " . $description);
        } catch (\Throwable $Throwable) {
            $loggingUtil->add("TRANSACTION", "failure " . $description);
            $message[] = "TRANSACTION: failure " . $description;

            $loggingUtil->add("CAUSED", $Throwable->getMessage());
            $message[] = "CAUSED: " . $Throwable->getMessage();

            try {
                DB::rollback();

                $loggingUtil->add("ROLLBACK", "success");
                $message[] = "ROLLBACK: success";
            } catch (\Throwable $Throwable2) {
                $loggingUtil->add("ROLLBACK", "failure");
                $message[] = "ROLLBACK: failure";

                $loggingUtil->add("CAUSED", $Throwable2->getMessage());
                $message[] = "CAUSED: " . $Throwable2->getMessage();
            }

            $exception = new \Exception(implode(PHP_EOL, $message), 0);
        }

        $loggingUtil->addEmphasis("TRANSACTION END");

        if ($isLogging) $loggingUtil->logging();

        if (!is_null($exception)) throw $exception;
    }
}
