<?php

use Illuminate\Support\Facades\Route;
use Junyan\Auth\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Plugin Routes
|--------------------------------------------------------------------------
|
| 在此处添加路由
|
*/

Route::group(["prefix" => "jauth"], function () {
    Route::group(["middleware" => ["web"]], function () {
        //登录
        Route::post("login", [LoginController::class, "login"]);
    });
    Route::group(["prefix" => "jauth", "middleware" => ["api"]], function () {
        //通过账号获取验证码
        Route::get("sendCode", [LoginController::class, "sendCode"]);
        //API登录
        Route::post("login", [LoginController::class, "login"]);
    });
});
