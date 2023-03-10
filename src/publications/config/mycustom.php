<?php

return [
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
    "api_access_token"        => env("API_ACCESS_TOKEN", "secret"),
    "api_access_token_header" => env("API_ACCESS_TOKEN_HEADER", "X-API-Access-Token"),


    /**
     * Logging
     * 
     * 各項目をログに出力するかどうか
     * 
     * logging_access_path      : bool アクセスされたURLのpath
     * logging_access_method    : bool アクセスされたControllerのmethod
     * logging_access_time      : bool アクセスされた一連の実行時間
     * logging_access_memory    : bool アクセスされた一連のメモリ使用量
     * logging_access_user_agent: bool アクセスしたユーザのuser agent
     * logging_access_ip        : bool アクセスした端末のIP address
     * 
     */
    "logging_access_path"       => true,
    "logging_access_method"     => true,
    "logging_access_time"       => true,
    "logging_access_memory"     => true,
    "logging_access_user_agent" => true,
    "logging_access_ip"         => true,


    /**
     * etc.
     * 
     * result_nullable: ResultクラスをJSONシリアライズする際にnullなプロパティを許容するかどうか
     * 
     * 
     */
    "result_nullable" => true,

    "system_alert" => [
        "subject" => "System Alert",
        "from" => [
            "address" => env("SYSTEM_ALERT_FROM_ADDRESS"),
            "name"    => env("SYSTEM_ALERT_FROM_NAME")
        ],
        "to" => [
            "address" => env("SYSTEM_ALERT_TO_ADDRESS")
        ]
    ]
];
