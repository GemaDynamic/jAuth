<?php

namespace Junyan\Auth\Exceptions;

use Exception as BaseException;

class Exception extends BaseException
{
    public function rendor($request)
    {
        throw $this;
    }
}
