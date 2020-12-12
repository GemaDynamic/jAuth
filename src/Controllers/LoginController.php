<?php

namespace Junyan\Auth\Controllers;

use Junyan\Auth\Requests\LoginRequest;
use Junyan\Auth\Traits\AuthTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthTrait;
    /**
     * 登录
     */
    public $redirectTo = "/";
    public function login(LoginRequest $request)
    {
        dd("233");
        $data = $request->validated();
        $method = "loginBy" . ucfirst($request->type);
        $res = $this->$method($data, $request->remember);
        return $res;
    }

    /**
     * 退出
     */
    public function logout(Request $request)
    {
        # code...
    }
    public function sendCode(Request $request)
    {
        $res = $this->setCode($request->account);
        if ($res) {
            return success();
        }
    }
}
