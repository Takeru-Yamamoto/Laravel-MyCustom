<?php

use App\Enums\UserAuthorityEnum;

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
    "site_name"        => env("APP_NAME", "Laravel CMS"),
    "meta_description" => env("META_DESCRIPTION", ""),
    "default_prefix"   => env("DEFAULT_PREFIX", ""),
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
     * Sidebar
     * 
     * サイドバー設定
     * 
     * ページURLプレフィックス: vendor/takeru-yamamoto/laravel-presentation-domain/src/Helpers/blade.php 
     * 
     * pages => [
     *      (ページURLプレフィックス) => [
     *          Basic
     *              can  : サイドバーを表示する権限
     *              class: サイドバーに付与するクラス名
     * 
     *          Title
     *              title      : サイドバーで表示するページタイトル
     *              title_class: サイドバーで表示するページタイトルクラス
     * 
     *          URL
     *              link  : サイドバーで使用するURLリンク
     *              route : サイドバーで使用するURLのRoute
     *              params: routeで使用するパラメータ 配列の形で使用する
     * 
     *          Icon
     *              icon      : サイドバーで使用するFont Awesome Icon
     *              icon_class: サイドバーで使用するアイコンクラス
     * 
     *          Etc.
     *              children: サイドバーに表示する下部メニュー 配列の形で使用する
     *      ]
     * ]
     * 
     * 
     */
    "pages" => [
        "login_info" => [
            "title" => "login_info.title",
            "route" => "login_info.index",
            "icon"  => "fa-solid fa-gear",
            "can"   => UserAuthorityEnum::USER_HIGHER,
        ],
        "user" => [
            "title" => "user.title",
            "route" => "user.index",
            "icon"  => "fa-solid fa-user",
            "can"   => UserAuthorityEnum::ADMIN_HIGHER,
        ],
    ],


    /**
     * User Menu
     * 
     * ユーザーメニュー設定
     * ページ右上に表示されるログイン中のユーザー名をクリックすると表示されるメニュー
     * 
     * usermenu_header: usermenu_header セッションを使用するかどうか
     * usermenu_body  : usermenu_body セッションを使用するかどうか
     * usermenu_footer: usermenu_footer セッションを使用するかどうか
     * 
     * btn_login : 未ログイン時にユーザーメニューのフッターにログインボタンを表示するかどうか 
     * btn_logout: ログイン時にユーザーメニューのフッターにログアウトボタンを表示するかどうか
     * 
     */
    "usermenu_header" => env("USERMENU_HEADER", false),
    "usermenu_body"   => env("USERMENU_BODY", false),
    "usermenu_footer" => env("USERMENU_FOOTER", false),

    "btn_login"  => env("BTN_LOGIN", true),
    "btn_logout" => env("BTN_LOGOUT", true),


    /**
     * Footer
     * 
     * page_footer           : bool サイトのフッターを表示するかどうか
     * copyright_holder_name : string サイトの著作権者名
     * first_publication_year: int 著作権発生年
     * 
     */
    "page_footer"            => env("PAGE_FOOTER", false),
    "copyright_holder_name"  => env("COPYRIGHT_HOLDER_NAME", ""),
    "first_publication_year" => env("FIRST_PUBLICATION_YEAR", 0),


    /**
     * Icon
     * 
     * view_icon: bool ログイン画面やサイドバーなどにアイコンを表示するかどうか
     * icon_path: string 表示するアイコンのパス。asset(config("mycustom.icon_path"))
     * 
     * favicon_path: string 表示するfaviconのパス。asset(config("mycustom.favicon_path"))
     * 
     */
    "view_icon" => env("VIEW_ICON", false),
    "icon_path" => env("ICON_PATH", ""),

    "favicon_path" => env("FAVICON_PATH", ""),


    /**
     * Logging
     * 
     * 各項目をログに出力するかどうか
     * 
     * logging_request_url        : bool アクセスURL
     * logging_request_http_method: bool アクセスHTTPメソッド
     * logging_request_user_agent : bool アクセスしたユーザのUser Agent
     * logging_request_ip_address : bool アクセスした端末のIP Address
     * 
     * logging_response_status : bool レスポンスのステータスコードとテキスト
     * 
     * logging_execution_time   : bool リクエストからレスポンスまでの実行時間
     * logging_memory_peak_usage: bool リクエストからレスポンスまでの最大メモリ使用量
     * 
     * logging_sql        : bool 実行されたSQL文
     * logging_transaction: bool データベースのトランザクション
     * 
     */
    "logging_request_url"         => env("LOGGING_REQUEST_URL", true),
    "logging_request_http_method" => env("LOGGING_REQUEST_HTTP_METHOD", true),
    "logging_request_user_agent"  => env("LOGGING_REQUEST_USER_AGENT", true),
    "logging_request_ip_address"  => env("LOGGING_REQUEST_IP_ADDRESS", true),

    "logging_response_status" => env("LOGGING_RESPONSE_STATUS", true),

    "logging_execution_time"    => env("LOGGING_EXECUTION_TIME", true),
    "logging_memory_peak_usage" => env("LOGGING_MEMORY_PEAK_USAGE", true),

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
