<?php

use Illuminate\Support\Facades\Mail;
use MyCustom\Exceptions\SystemAlert;

if (!function_exists('sendSystemAlert')) {

    /**
     * config/mycustom.phpに定義されている情報を用いて SystemAlert を送信する
     * app/Exceptions/Handler.php::register()内で使用することで、Exception が発生した場合にSystemAlertを送信することができる
     * 
     * @param \Throwable $e
     */

    // // 使用例
    // public function register(): void
    // {
    //      $this->reportable(function (Throwable $e) {
    //          sendSystemAlert($e);
    //      });
    // }

    function sendSystemAlert(\Throwable $e): bool
    {
        if (empty(config("mycustom.system_alert.to.address")) || empty(config("mycustom.system_alert.from.address")) || empty(config("mycustom.system_alert.from.name"))) {
            dividerLog();
            infoLog("SYSTEM ALERT CANNOT SEND");
            infoLog("PLEASE CHECK .env AND SET ABOUT SYSTEM ALERT IF YOU WANT TO RECEIVE SYSTEM ALERT");
            dividerLog();

            return true;
        }

        Mail::to(config("mycustom.system_alert.to.address"))->send(new SystemAlert($e));
        return true;
    }
}
