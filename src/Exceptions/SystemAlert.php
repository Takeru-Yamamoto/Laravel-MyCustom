<?php

namespace MyCustom\Exceptions;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Throwable;

/**
 * システムアラート送信クラス
 */
class SystemAlert extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * 検出された例外等
     *
     * @var Throwable
     */
    private Throwable $throwable;

    /**
     * システムアラートの件名
     * const/email.php 内で定義しておく
     *
     * @var string
     */
    private string $subject;

    function __construct(Throwable $throwable)
    {
        $this->throwable = $throwable;
        $this->subject   = config("mycustoms.email.subject_head") . config("mycustoms.email.system_alert.subject");
    }

    public function build()
    {
        $data = [
            "throwable" => $this->throwable
        ];

        return $this->view("emails.systemAlert")
            ->subject($this->subject)
            ->from(config("mycustoms.email.system_alert.from.address"), config("mycustoms.email.system_alert.from.name"))
            ->with($data);
    }
}
