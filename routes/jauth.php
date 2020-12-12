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

Route::group(["prefix" => "jauth"], function () {
    Route::group(["middleware" => ["web"]], function () {
        //用户中心页
        Route::get("/", [HomeController::class, "index"])->name("jauth.home");
        //登录页
        Route::get("login", [LoginController::class, "loginPage"]);
        //登录
        Route::post("login", [LoginController::class, "login"])->name("jauth.login");
        //退出
        Route::post("logout", [LoginController::class, "logout"])->name("jauth.logout");
    });
    Route::group(["prefix" => "jauth", "middleware" => ["api"]], function () {
        //通过账号获取验证码
        Route::get("sendCode", [LoginController::class, "sendCode"]);
        //API登录
        Route::post("login", [LoginController::class, "login"]);
        //API登出
        Route::post("logout", [LoginController::class, "logout"]);
    });
});
