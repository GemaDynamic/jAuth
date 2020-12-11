<?php

namespace Cyw\Wechat\Facades;

use Junyan\Auth\Auth as JAuth;
use Illuminate\Support\Facades\Facade;

class Auth extends Facade
{
    /**
     * Class WechatAuth.
     *
     * @method  类型(static)  返回值类型  functionName(...$param)
     * @method static \Encore\Admin\Grid grid($model, \Closure $callable)
     *
     * @see \Cyw\WechatAuth\WechatAuth
     */
    protected static function getFacadeAccessor()
    {
        return JAuth::class;
    }
}
