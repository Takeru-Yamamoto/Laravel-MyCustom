<?php

return [
    /**
     * 
     * Basic
     * 
     * 基本設定
     * 
     * site_name       : string サイト名。ログイン画面やサイドバー、titleタグに設定される
     * meta_description: string サイトにアクセスする際に使用されているデフォルトのURLプレフィックス
     * default_prefix  : string サイトにアクセスする際に使用されているデフォルトのURLプレフィックス
     * custom_handler  : bool カスタムされたエラーハンドラーを使用するかどうか
     * force_url       : bool サイトにアクセスする際にURLプレフィックスを強制するかどうか
     * 
     */
    "custom_handler"   => env("CUSTOM_HANDLER", true),
    "force_url"        => env("FORCE_URL", false),

    /**
     * 
     * Access
     * 
     * ログインや認可・認証設定
     * 
     * required_login  : アプリケーションにアクセスする際にログインが必須かどうか
     * api_access_token: APIのアクセストークン
     */
    "default_gate"            => env("DEFAULT_GATE", true),
    "required_login"          => env("REQUIRED_LOGIN", false),
    "api_access_token"        => env("API_ACCESS_TOKEN", ""),
    "api_access_token_header" => env("API_ACCESS_TOKEN_HEADER", "X-API-Access-Token"),

    /**
     * 
     * System Alert
     * 
     * システムアラート設定
     * 
     * is_send     : bool システムアラートを送信するかどうか
     * subject     : string システムアラートのメールタイトル
     * from.address: string 送信元アドレス
     * from.name   : string 送信元名
     * to.address  : array 送信先アドレス
     * 
     */
    "system_alert" => [
        "is_send" => env("SYSTEM_ALERT_IS_SEND", true),
        "subject" => env("SYSTEM_ALERT_SUBJECT", "System Alert"),
        "from" => [
            "address" => env("SYSTEM_ALERT_FROM_ADDRESS", "system-alert@example.com"),
            "name"    => env("SYSTEM_ALERT_FROM_NAME", env("APP_NAME") . "@" . env("APP_ENV"))
        ],
        "to" => [
            "address" => []
        ]
    ],

    /**
     * Logging
     * 
     * 各項目をログに出力するかどうか
     * 
     * logging_sql        : bool 実行されたSQL文
     * logging_transaction: bool データベースのトランザクション
     * 
     */
    "logging_sql"         => env("LOGGING_SQL", false),
    "logging_transaction" => env("LOGGING_TRANSACTION", false),

    /**
     * 
     * SNS
     * 
     * email_from_address: メールの送信元アドレス
     * email_from_name   : メールの送信元名
     * 
     * line_access_token      : BaseLineで使用するLINE Messaging APIのアクセストークン
     * line_channel_secret    : BaseLineで使用するLINE Messaging APIのチャンネルシークレットキー
     * 
     * twilio_from            : BaseSmsで使用するTwilioの送信元電話番号
     * twilio_account_sid     : BaseSmsで使用するTwilioの送信元アカウントSID
     * twilio_auth_token      : BaseSmsで使用するTwilioのオーストークン
     * twilio_status_callback : BaseSmsで使用するTwilioの送信結果を受け取るURL
     * 
     */
    "email_from_address"      => env("GLOBAL_EMAIL_FROM_ADDRESS", "noreply@example.com"),
    "email_from_name"         => env("GLOBAL_EMAIL_FROM_NAME", env("APP_NAME") . "@" . env("APP_ENV")),

    "line_access_token"       => env("LINE_ACCESS_TOKEN", ""),
    "line_channel_secret"     => env("LINE_CHANNEL_SECRET", ""),

    "twilio_from"             => env("TWILIO_FROM", ""),
    "twilio_account_sid"      => env("TWILIO_ACCOUNT_SID", ""),
    "twilio_auth_token"       => env("TWILIO_AUTH_TOKEN", ""),
    "twilio_status_callback"  => env("TWILIO_STATUS_CALLBACK", ""),
];
