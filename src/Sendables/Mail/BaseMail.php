<?php

namespace MyCustom\Sendables\Mail;

use MyCustom\Sendables\Sendable;

use MyCustom\Utils\Facades\Logging;

use Illuminate\Support\Facades\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * 基底メールクラス
 */
abstract class BaseMail extends Mailable implements Sendable
{
    use Queueable, SerializesModels;

    /**
     * 使用するviewのbladeファイル名
     *
     * @var string
     */
    public string $viewName;

    /**
     * 件名
     *
     * @var string
     */
    public string $emailSubject;

    /**
     * 送信元アドレス
     *
     * @var string
     */
    public string $fromAddress;

    /**
     * 送信元名
     *
     * @var string
     */
    public string $fromName;

    /**
     * viewName 内で使用するデータ
     *
     * @var array
     */
    public array $data;

    /**
     * 送信先アドレス
     *
     * @var string
     */
    public string $toAddress;


    function __construct(array $data, string $toAddress)
    {
        $this->data      = $data;
        $this->toAddress = $toAddress;

        $this->viewName     = $this->viewName();
        $this->emailSubject = $this->emailSubject();
        $this->fromAddress  = $this->fromAddress();
        $this->fromName     = $this->fromName();
    }

    public function build(): Mailable
    {
        return $this->view("emails." . $this->viewName)
            ->subject($this->emailSubject)
            ->to($this->toAddress)
            ->from($this->fromAddress, $this->fromName)
            ->with($this->data);
    }

    protected function fromAddress(): string
    {
        return config("mycustom.email_from_address");
    }

    protected function fromName(): string
    {
        return config("mycustom.email_from_name");
    }

    abstract protected function viewName(): string;
    abstract protected function emailSubject(): string;

    /**
     * 送信可能かどうか
     *
     * @return bool
     */
    public function isSendable(): bool
    {
        return !empty($this->toAddress)
            && !empty($this->fromAddress)
            && !empty($this->fromName)
            && !empty($this->viewName)
            && !empty($this->emailSubject);
    }


    /*----------------------------------------*
     * Sendable
     *----------------------------------------*/

    /**
     * 送信する
     *
     * @return bool
     */
    public function sending(): bool
    {
        $loggingUtil = Logging::info();

        if (!$this->isSendable()) {
            $loggingUtil->addDivider();
            $loggingUtil->add("MAIL CANNOT SEND");
            $loggingUtil->add("Prease check .env and set about mail if you want to send");
            $loggingUtil->addDivider();

            $loggingUtil->logging();

            return false;
        }

        $loggingUtil->addEmphasis("SEND MAIL LOGGING START");

        $loggingUtil->add("to", $this->toAddress);

        $loggingUtil->addEmphasis("SEND MAIL LOGGING END");

        $loggingUtil->logging();

        return !is_null(Mail::send($this));
    }
}
