<?php

use Illuminate\Http\JsonResponse;

if (!function_exists("pathPrefix")) {

    /**
     * requestのpathのprefixを取得する
     */
    function pathPrefix(?string $defaultPrefix = null): string
    {
        $path = request()->path();

        if (!is_null($defaultPrefix) && str_contains($path, $defaultPrefix)) $path = str_replace($defaultPrefix . "/", "", $path);

        return explode("/", $path)[0];
    }
}

if (!function_exists("___")) {

    /**
     * trans()のwrap
     * pagesディレクトリ配下にも簡単にアクセスできるようにする
     */
    function ___(string $lang, array $replace = []): string
    {
        return $lang === __($lang) ? __("pages" . DIRECTORY_SEPARATOR . $lang, $replace) : __($lang, $replace);
    }
}

if (!function_exists("responseJson")) {

    /**
     * JsonResponse の簡略化
     *
     * @param mixed $data
     */
    function responseJson(mixed $data = []): JsonResponse
    {
        return response()->json($data);
    }
}

if (!function_exists("formId")) {

    /**
     * 現在のrouteを用いてformに使用するidを取得する
     * form submit btn と併用する
     * num は現在のページにformが複数存在するときの重複回避用
     *
     * @param integer|null $num
     */
    function formId(?int $num = null): string
    {
        return str_replace("/", "-", request()->path()) . "-form" . $num;
    }
}
