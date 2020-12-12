<?php

namespace Junyan\Auth\Exceptions;

class LoginCodeExpiredException extends Exception
{
    public function __construct($message = "验证码已过期", $code = 0)
    {
        # code...
    }
}
