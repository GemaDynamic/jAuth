<?php

namespace Junyan\Auth\Controllers;

use Junyan\Auth\Requests\LoginRequest;
use Junyan\Auth\Traits\AuthTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * 个人主页
     */
    public function index(Request $request)
    {
        return view("jauth::home");
    }
}
