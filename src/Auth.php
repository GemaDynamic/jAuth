<?php

namespace Junyan\Auth;

class Auth
{
    /**
     *paramaters
     */
    protected $config;

    /**
     * functions
     */
    public function __construce($config = [])
    {
        $this->config = $config;
        $this->init();
    }

    protected function init()
    {
        # code...
    }
}
