<?php

namespace Junyan\Auth\Exceptions;

use Exception;

class WrongPasswordException extends Exception
{
    public function __construct($message = "密码错误", $code = 0)
    {
        # code...
    }
}
