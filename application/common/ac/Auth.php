<?php
namespace app\common\ac;

use think\Model;
use think\Cookie;
use think\Request;

class Auth
{
    public $cookiename = 'www_ghck_rtui';
    public $cookiehash = 'WERTYUIO1234567ghy3245678';
    public $expiretime = 86400;
    public $veriefycookie = false;
    public $username = '';          //true 表示登陆成功

    public function __construct(){
        $this->cookiename = \think\Config::get('authcookieusername');
        $this->cookiehash = \think\Config::get('authcookiehashkey');
        $this->expiretime = \think\Config::get('authcookieexpiretime');
    }

    public function auth($username, $password)
    {
        //验证
        $username = trim($username);
        $password = trim($password);
        //验证用户名密码是否正确
        $userinfo = md('User')
            ->where('name',$username)
            ->where('enable',1)
            ->find();

        if($userinfo){
            if(ac('Password')->verify($password,$userinfo['password'])){
                $this->username = $username;
                $v['username'] = $username;
                $v['marktime'] = time();
                $v['verify'] = sha1($this->cookiehash.$v['username'].$v['marktime']);
                Cookie::set($this->cookiename,$v,$this->expiretime);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    /*
     * 清除cookie
     */
    public function clear()
    {
        //清楚cookie状态
        Cookie::delete($this->cookiename);
        return true;
    }

    public function IsLogin()
    {
        if($this->veriefy()){
            return true;
        }else{
            return false;
        }
    }

    public function veriefy()
    {
        if($this->veriefycookie)return true;
        $cookieinfo = $this->cookieinfo = Cookie::get($this->cookiename);
        //空
        if(empty($cookieinfo)){
            $this->veriefycookie = false;
        }
        //不是数组
        if(!is_array($cookieinfo)){
            $this->veriefycookie = false;
        }
        //空
        if(!isset($cookieinfo['verify'])
            || !isset($cookieinfo['username'])
            || !isset($cookieinfo['marktime'])){
            $this->veriefycookie = false;
            return $this->veriefycookie;
        }
        $this->username = $cookieinfo['username'];
        //验证数据
        if($cookieinfo['verify'] == sha1($this->cookiehash.$cookieinfo['username'].$cookieinfo['marktime'])){
            $this->veriefycookie = true;
        }else{
            $this->veriefycookie = false;
        }
        return $this->veriefycookie;
    }

}
