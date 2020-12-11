<?php

namespace Junyan\Auth\Controller;

use Junyan\Auth\Requests\LoginRequest;
use Junyan\Auth\Traits\AuthTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // public $service;
    // public function __construct(AuthService $authService)
    // {
    //     $this->service = $authService;
    // }
    use AuthTrait;
    /**
     * 登录
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        switch ($data["type"]) {
            case "code":
        }
    }

    /**
     * 退出
     */
    public function logout(Request $request)
    {
        # code...
    }
}
