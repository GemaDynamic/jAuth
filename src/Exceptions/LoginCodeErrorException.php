<?php

namespace Junyan\Auth\Exceptions;

use Exception;

class LoginCodeErrorException extends Exception
{
    public function __construct($message = "验证码错误", $code = 0)
    {
        # code...
    }
}
