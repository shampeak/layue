<?php
namespace app\common\ac;

use think\Model;
use think\Cookie;
use think\Request;

class My extends Model
{

//    public $cookieinfo = '';
    public $cookiename = '';

    public $login   = '';
    public $info    = [];
    public $group = [];
    public $groupId = '';
    public $userId  = '';
    public $root    = '';
    public $isLogin = false;

    public function __construct(){
        if(ac('Auth')->veriefy()){
            $this->isLogin = true;

            $cookieinfo = Cookie::get(\think\Config::get('authcookieusername'));
            $this->name = $cookieinfo['username'];
            $row = md('User')
                ->where('name',$this->name)
                ->where('enable',1)
                ->find();
            if(empty($row)){
                $this->isLogin = false;
            }else{
                $this->info = $row->toArray();
                //todo enable = 0的情况需要解析
                $this->userId = $this->info['uId'];

                //======================================
                //角色id
                $this->groupId = $row['groupId'];
                $this->group = $row->group;
                $this->groupads = $row->groupads;

            }
        }else{
            $this->isLogin = false;
        }

    }

    public function isLogin()
    {
        return $this->isLogin;
    }


    public function getInfo()
    {
        return $this->info;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    /*
     * 角色信息
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    public function getGroup()
    {
        return $this->group;
    }

    /*
     * 权限信息
     */
    public function getGroupAds()
    {
        $row = $this->groupads;
        if($row){
            $pw = json_decode($row['adsIds']);
        }else{
            $pw = [];
        }
        return $pw;
    }


}
