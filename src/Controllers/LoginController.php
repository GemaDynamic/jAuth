<?php

namespace Junyan\Auth\Controllers;

use Junyan\Auth\Requests\LoginRequest;
use Junyan\Auth\Traits\AuthTrait;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthTrait;

    /**
     * 获取登录页面
     */
    public function loginPage(Request $request)
    {
        $data = ["redirectTo" => $this->getRedirectTo($request)];
        $action = route("login", $data);
        return view("jauth::login", compact("action"));
    }

    /**
     * 登录
     */
    public function login(LoginRequest $request)
    {
        $request->validated();
        $data = $request->only(["account", $request->type]);
        $method = "loginBy" . ucfirst($request->type);
        $res = $this->$method($data, $request->remember);
        // dd("???");
        // dd($res);
        return $res;
    }

    /**
     * 退出
     */
    public function logout(Request $request)
    {
        auth()->logout(auth()->user());
        return $request->wantsJson() ? success() : back()->with("success", "退出成功");
    }
    /**
     * 获取验证码
     */
    public function sendCode(Request $request)
    {
        $res = $this->setCode($request->account);
        if ($res) {
            return success();
        } else {
            return error();
        }
    }
}
