<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| これは Laravel-MyCustomで作成されたデフォルトのWebルートファイルです。
|
*/

Route::get("/", function () {
    return redirect()->route("home");
});

Route::get("/home", [Controller\HomeController::class, "index"])->name("home");

Route::get("/login", [Controller\Auth\LoginController::class, "showLoginForm"])->name("showLoginForm");
Route::post("/login", [Controller\Auth\LoginController::class, "login"])->name("login");
Route::post("/logout", [Controller\Auth\LoginController::class, "logout"])->name("logout");

Route::get("/password_forgot", [Controller\Auth\PasswordForgotController::class, "showEmailInputForm"])->name("showEmailInputForm");
Route::post("/password_forgot", [Controller\Auth\PasswordForgotController::class, "receiveEmailAddress"])->name("receiveEmailAddress");
Route::get("/password_reset/{crypted}", [Controller\Auth\PasswordForgotController::class, "passwordResetForm"])->name("passwordResetForm");
Route::post("/password_reset", [Controller\Auth\PasswordForgotController::class, "passwordReset"])->name("passwordReset");

Route::group(["middleware" => "auth"], function () {
    Route::get("/phpinfo", function () {
        phpinfo();
    });

    // ユーザ
    Route::group(["middleware" => ["can:user-higher"]], function () {
        Route::group(["prefix" => "login_info", "as" => "login_info."], function () {
            Route::get("/", [Controller\LoginInfoController::class, "index"])->name("index");
            Route::post("/update", [Controller\LoginInfoController::class, "update"])->name("update");
            Route::get("/change_email", [Controller\LoginInfoController::class, "changeEmailForm"])->name("changeEmailForm");
            Route::post("/create_authentication_code", [Controller\LoginInfoController::class, "createAuthenticationCode"])->name("createAuthenticationCode");
            Route::get("/authentication_code", [Controller\LoginInfoController::class, "authenticationCodeForm"])->name("authenticationCodeForm");
            Route::post("/change_email", [Controller\LoginInfoController::class, "changeEmail"])->name("changeEmail");
        });
    });

    // 管理者
    Route::group(["middleware" => ["can:admin-higher"]], function () {
        Route::group(["prefix" => "user", "as" => "user."], function () {
            Route::get("/", [Controller\UserController::class, "index"])->name("index");
            Route::get("/create", [Controller\UserController::class, "createForm"])->name("createForm");
            Route::post("/create", [Controller\UserController::class, "create"])->name("create");
            Route::get("/update/{id}", [Controller\UserController::class, "updateForm"])->name("updateForm");
            Route::post("/update", [Controller\UserController::class, "update"])->name("update");
            Route::post("/delete", [Controller\UserController::class, "delete"])->name("delete");
            Route::post("/change_is_valid", [Controller\UserController::class, "changeIsValid"])->name("changeIsValid");
        });
    });

    // システム管理者
    Route::group(["middleware" => ["can:system"]], function () {
    });
});
