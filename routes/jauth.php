<?php

use Illuminate\Support\Facades\Route;
use Junyan\Auth\Controllers\HomeController;
use Junyan\Auth\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Plugin Routes
|--------------------------------------------------------------------------
|
| 在此处添加路由
|
*/

if (config("jauth.route.enable")) {
    Route::group(["middleware" => ["web"]], function () {
        $arr = [];
        $api_prefix = config("jauth.route.web.prefix", null);
        $api_prefix && $arr['prefix'] = $api_prefix;
        Route::group($arr, function () {
            //登录页
            Route::get("login", [LoginController::class, "loginPage"])->name("login")->middleware("guest");
            //登录
            Route::post("login", [LoginController::class, "login"]);
            //退出
            Route::post("logout", [LoginController::class, "logout"])->name("logout");
        });

        Route::group(['middleware' => 'auth'], function () {
            //用户中心页
            Route::get("home", [HomeController::class, "index"])->name("home");
        });
    });
    Route::group(["prefix" => "api", "middleware" => ["api"]], function () {
        $arr = [];
        $api_prefix = config("jauth.route.api.prefix", null);
        $api_prefix && $arr['prefix'] = $api_prefix;
        Route::group($arr, function () {
            //通过账号获取验证码
            Route::get("sendCode", [LoginController::class, "sendCode"]);
            //API登录
            Route::post("login", [LoginController::class, "login"]);
            //API登出
            Route::post("logout", [LoginController::class, "logout"]);
        });
    });
}
