<?php

namespace MyCustom\Sendables\Sms;

use MyCustom\Sendables\Sendable;

use MyCustom\Utils\Facades\Logging;

use Twilio\Rest\Client as TwilioClient;

/**
 * 基底Smsクラス
 */
abstract class BaseSms implements Sendable
{
    /**
     * 送信先
     *
     * @var string
     */
    public string $to;

    /**
     * 送信するメッセージ
     *
     * @var string
     */
    public string $message;

    /**
     * 送信元
     *
     * @var string
     */
    public string $from;

    /**
     * TwilioアカウントSID
     *
     * @var string
     */
    public string $accountSid;

    /**
     * Twilio認証トークン
     *
     * @var string
     */
    public string $authToken;

    /**
     * ステータスコールバック
     *
     * @var string
     */
    public string $statusCallback;


    function __construct(string $to, string $message)
    {
        $this->to      = $to;
        $this->message = $message;

        $this->from           = $this->from();
        $this->accountSid     = $this->accountSid();
        $this->authToken      = $this->authToken();
        $this->statusCallback = $this->statusCallback();
    }

    protected function from(): string
    {
        return config("mycustom.twilio_from");
    }

    protected function accountSid(): string
    {
        return config("mycustom.twilio_account_sid");
    }

    protected function authToken(): string
    {
        return config("mycustom.twilio_auth_token");
    }

    protected function statusCallback(): string
    {
        return config("mycustom.twilio_status_callback");
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
        $client = new TwilioClient($this->accountSid, $this->authToken);
        $response = $client->messages->create($this->to, ["from" => $this->from, "body" => $this->message, "statusCallback" => $this->statusCallback]);

        $responseArray = $response->toArray();

        if (!is_null($responseArray["errorCode"]) || !is_null($responseArray["errorMessage"])) return false;

        $loggingUtil = Logging::info();

        $loggingUtil->addEmphasis("SEND SMS LOGGING START");

        $loggingUtil->add("to", $this->to);
        $loggingUtil->add("message", $this->message);
        $loggingUtil->addEmpty();

        $loggingUtil->add("response to", jsonEncode($responseArray["to"]));
        $loggingUtil->add("response from", jsonEncode($responseArray["from"]));
        $loggingUtil->add("response body", jsonEncode($responseArray["body"]));
        $loggingUtil->add("response status", jsonEncode($responseArray["status"]));
        $loggingUtil->add("response sid", jsonEncode($responseArray["sid"]));
        $loggingUtil->add("response errorCode", jsonEncode($responseArray["errorCode"]));
        $loggingUtil->add("response errorMessage", jsonEncode($responseArray["errorMessage"]));

        $loggingUtil->addEmphasis("SEND SMS LOGGING END");

        $loggingUtil->logging();

        return true;
    }
}
