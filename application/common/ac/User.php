<?php
namespace app\common\ac;

use think\Model;
use think\Cookie;
use think\Request;

/*
 * 安全问题，调用需要检查权限
 *
 */
class User extends Model
{

    public $uId = 0;
    public $row     = [];   //行信息
    public $profile = [];   //属性星系
    public $role    = [];   //角色信息
    public $log     = [];   //日志信息
    //==============================================
    public $action    = [];   //动作


    public function __construct(){

    }

    public function setUid($uid = 0){
        $this->uId = $uid;
        return $this;
    }


    public function getProfile(){
        $uid = $this->uId;
        $user = md('user')->find($uid);
        return $user->profile;
    }


    public function getRow(){
        $uid = $this->uId;
        $this->row = md('user')->find($uid);
        return $this->row;
    }

    /*
     * 动作 登陆
     * //记录时间，变更ip
     */
    public function actLogin(){
    }

    /*
     * 登出
     */
    public function actLogout(){
    }

    public function actToken(){
    }

    public function log($actionname = '',$code = 0,$level = 1){
    }




}
