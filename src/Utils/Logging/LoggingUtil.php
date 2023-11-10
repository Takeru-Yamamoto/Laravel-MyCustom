<?php

namespace MyCustom\Utils\Logging;

use MyCustom\Jsonables\BaseJsonable;

use MyCustom\Utils\Logging\Enums\LogLevelEnum;

final class LoggingUtil extends BaseJsonable
{
    public readonly LogLevelEnum $logLevel;

    private array $messages = [];
    private string $outputDirectory = "";

    function __construct(LogLevelEnum $logLevel)
    {
        $this->logLevel = $logLevel;
    }

    /**
     * ログの出力までの一連の処理を実行する
     *
     * @return void
     */
    public function logging(): void
    {
        // $messagesが空の場合は、ログ出力しない
        if (empty($this->messages)) return;

        // ログレベルがDEBUGであり、APP_ENVがlocal以外の場合は、ログ出力しない
        if ($this->logLevel === LogLevelEnum::DEBUG && !app()->isLocal()) return;

        // ログの共通部分
        $commonOutput = $this->commonOutput();

        // ログを出力する
        foreach ($this->messages as $message) {
            $this->output($commonOutput . $message);
        }
    }

    /**
     * ログの共通部分を作成する
     *
     * @return string
     */
    private function commonOutput(): string
    {
        $commonOutput = "";

        // ログ出力時の日時
        $commonOutput .= "[" . date("Y-m-d H:i:s") . "]";

        // ログ出力時のAPP_ENV
        $commonOutput .= "[" . config("app.env") . "]";

        // 共通部分とメッセージの間には、コロンとスペースを入れる
        $commonOutput .= ": ";

        return $commonOutput;
    }

    /**
     * ログを出力する
     *
     * @param string $message
     * @return void
     */
    private function output(string $message): void
    {
        $outputDirectory = empty($this->outputDirectory) ? $this->logLevel->value : $this->outputDirectory;

        // ログを出力するディレクトリのパス
        $path = storage_path("logs" . DIRECTORY_SEPARATOR . $outputDirectory);

        // ログ出力先のディレクトリが存在しない場合は、ディレクトリを作成する
        if (!file_exists($path)) mkdir($path, 0777, true);

        // ログを出力するファイル名
        $fileName = date("Y-m-d") . ".log";

        // ログを出力するファイルのパス
        $filePath = $path . DIRECTORY_SEPARATOR . $fileName;

        // ログを出力する
        file_put_contents($filePath, $message . PHP_EOL, FILE_APPEND);
    }



    /*----------------------------------------*
     * Add Message
     *----------------------------------------*/

    /**
     * 出力するメッセージを追加する
     *
     * @param mixed $message
     * @return self
     */
    public function add(mixed $message, mixed $value = null, bool $isEmphasis = false): static
    {
        // $valueが配列かオブジェクトの場合は、オブジェクトをJSONに変換する
        if (is_array($value) || is_object($value)) $value = jsonEncode($value);

        // $messageが配列かオブジェクトの場合は、オブジェクトをJSONに変換する
        if (is_array($message) || is_object($message)) $message = jsonEncode($message);

        // $messageがboolの場合は、文字列に変換する
        if (is_bool($message)) $message = boolString($message);

        // $valueがboolの場合は、文字列に変換する
        if (is_bool($value)) $value = boolString($value);

        // $valueがnullでない場合は、$messageと$valueをキーと値の形式で$messageに追加する
        if (!is_null($value)) $message = (string) $message . ": " . (string) $value;

        // $isEmphasisがtrueの場合は、ログに追加するメッセージを強調する
        $this->messages[] = $isEmphasis ? "===== " . (string) $message . " =====" : (string) $message;

        return $this;
    }

    /**
     * 出力するメッセージを強調して追加する
     *
     * @param mixed $message
     * @return self
     */
    public function addEmphasis(mixed $message): static
    {
        return $this->addEmpty()->add($message, isEmphasis: true)->addEmpty();
    }

    /**
     * ログに共通部分だけの空の行を追加する
     *
     * @return self
     */
    public function addEmpty(): static
    {
        return $this->add("");
    }

    /**
     * ログに共通部分だけの区切り線を追加する
     *
     * @return self
     */
    public function addDivider(): static
    {
        return $this->addEmpty()->add("===========================")->addEmpty();
    }

    /**
     * ログに共通部分だけの区切り線を追加する
     *
     * @param string $outputDirectory
     *
     * @return self
     */
    public function setOutputDirectory(string $outputDirectory): static
    {
        $this->outputDirectory = $outputDirectory;

        return $this;
    }
}
