<?php

namespace Junyan\Auth\Traits;

use Junyan\Auth\Models\User;
use Illuminate\Http\Response;
use Junyan\Auth\Exceptions\LoginCodeExpiredException;
use Junyan\Auth\Exceptions\LoginCodeErrorException;
use Illuminate\Support\Facades\Cache;
use Junyan\Auth\Exceptions\WrongPasswordException;

trait AuthTrait
{
    /**
     * 向账号添加验证码
     *
     * @param  string  $account  账号
     *
     * @return boolean  是否添加成功
     */
    public function setCode($account)
    {
        $code = Cache::tags(["login_code"])->get($account);

        $code || $code = random_int(100000, 999999);

        $res = $this->sendCodeSms($account, compact("code"))
            && Cache::tags(["login_code"])->set($account, $code, 5 * 60);

        return $res;
    }

    /**
     * 向手机号发送短信
     *
     * @param  string  $phone  手机号
     * @param  array  $params  短信所需data
     *
     * @return boolean
     */
    protected function sendCodeSms($phone, $params)
    {

        return true;
    }

    /**
     * 通过验证码登录
     *
     * @param  string  $account  账号
     * @param  string  $code     验证码
     *
     * @throw LoginCodeErrorException
     * @throw LoginCodeExpiredException
     */
    public function loginByCode($account, $code)
    {
        $cache_code = Cache::tags(["login_code"])->get($account);
        // 有
        if ($cache_code) {
            // 且正确
            if ($cache_code == $code) {
                $user = User::where($this->accountName, $account)->first();
                auth()->login($user);
                return $this->loginSuccess();
            } else {
                //验证码错误
                throw new LoginCodeErrorException();
            }
        } else {
            //验证码过期
            throw new LoginCodeExpiredException();
        }
    }

    /**
     * 通过密码登录
     *
     * @param  string  $account   账号
     * @param  string  $password  密码
     *
     * @throw WrongPasswordException
     *
     */
    public function loginByPassword($account, $password, $remember = false)
    {
        if (auth()->attempt([$account, $password], $remember)) {
            return $this->loginSuccess();
        } else {
            throw new WrongPasswordException();
        }
    }

    /**
     * 登录成功后的操作
     *
     * @return \Illuminate\Http\Response
     */
    public function loginSuccess()
    {
        return back();
    }
}
