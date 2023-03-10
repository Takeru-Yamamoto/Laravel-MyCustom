<?php

namespace MyCustom\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccessAnalysisMiddleware
{
    /**
     * applicationに対するすべてのリクエストをログに残すmiddleware
     * 
     * configの各項目のboolを用いて、どの項目に関するログを残すかを決定する
     *
     * @param Request $request
     * @param Closure $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            !config("mycustom.logging_access_path")
            && !config("mycustom.logging_access_method")
            && !config("mycustom.logging_access_time")
            && !config("mycustom.logging_access_memory")
            && !config("mycustom.logging_access_user_agent")
            && !config("mycustom.logging_access_ip")
        ) return $next($request);
        if (str_contains($request->getRequestUri(), "_debugbar")) return $next($request);

        dividerLog();
        infoLog("アクセス解析開始");
        emptyLog();

        $start = microtime(true);
        $res = $next($request);
        $stop = microtime(true);

        emptyLog();
        if (config("mycustom.logging_access_path")) infoLog("リクエストルート: " . e($request->getRequestUri()));
        if (config("mycustom.logging_access_method")) infoLog("HTTPメソッド: " . $request->method());
        if (config("mycustom.logging_access_time")) infoLog("実行時間計測結果: " . (($stop - $start) * pow(10, 3)) . "ms");
        if (config("mycustom.logging_access_memory")) infoLog("メモリ最大使用量: " . memory_get_peak_usage() / (1024 * 1024) . " MB (" . memory_get_peak_usage() . " byte)");
        if (config("mycustom.logging_access_user_agent")) infoLog("User Agent: " . $request->userAgent());
        if (config("mycustom.logging_access_ip")) infoLog("アクセスIPアドレス: " . $request->ip());

        dividerLog();

        return $res;
    }
}
