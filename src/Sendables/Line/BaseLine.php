<?php

namespace MyCustom\Sendables\Line;

use MyCustom\Sendables\Sendable;

use MyCustom\Utils\Facades\Logging;

use LINE\LINEBot as LineBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient as LineClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder as LineMessageBuilder;

/**
 * 基底Lineクラス
 */
abstract class BaseLine implements Sendable
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
     * アクセストークン
     *
     * @var string
     */
    public string $accessToken;

    /**
     * チャンネルシークレット
     *
     * @var string
     */
    public string $channelSecret;


    function __construct(string $to, string $message)
    {
        $this->to      = $to;
        $this->message = $message;

        $this->accessToken   = $this->accessToken();
        $this->channelSecret = $this->channelSecret();
    }

    protected function accessToken(): string
    {
        return config("mycustom.line_access_token");
    }

    protected function channelSecret(): string
    {
        return config("mycustom.line_channel_secret");
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
        $client   = new LineClient($this->accessToken);
        $bot      = new LineBot($client, ["channelSecret" => $this->channelSecret]);
        $response = $bot->pushMessage($this->to, new LineMessageBuilder($this->message));

        $loggingUtil = Logging::info();

        $loggingUtil->addEmphasis("SEND LINE LOGGING START");

        $loggingUtil->add("to", $this->to);
        $loggingUtil->add("message", $this->message);
        $loggingUtil->add("header", $response->getHeaders());
        $loggingUtil->add("body", $response->getJSONDecodedBody());
        $loggingUtil->add("status", $response->getHTTPStatus());

        $loggingUtil->addEmphasis("SEND LINE LOGGING END");

        $loggingUtil->logging();

        return $response->isSucceeded();
    }
}
