<?php

use Illuminate\Support\Facades\Route;
use Junyan\Auth\Controller\LoginController;

/*
|--------------------------------------------------------------------------
| Plugin Routes
|--------------------------------------------------------------------------
|
| 在此处添加路由
|
*/

//获取验证码

Route::get("sendCode",[LoginController::class,"sendCode"]);

//登录
Route::post("login",[LoginController::class,"login"]);
