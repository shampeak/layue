<?php
namespace app\common\ac\esb;

use think\Model;
use think\Cookie;
use think\Request;

/*
 * 无成本获取环境变量和参数
 */

class Role extends Base{

    public function __construct(){
        //注册所有的ads
        $this->a = Request::instance()->module();
        $this->d = Request::instance()->controller();
        $this->s = Request::instance()->action();
    }

    /*
     * //=====================================
     * //登陆检查
     * //是否需要检查
     * //权限检查
     * //=====================================
     */

    /*
     * 是否登陆检查
     */
    function getChecklogin(){
        return true;
    }

    function getCheckads(){
        return true;
    }

        /*
         * 权限检查
         */
    function getCheck(){
        $flag = true;
        if(!$this->getChecklogin() || !$this->getCheckads() ){
            $flag = false;
        }
        return $flag;
    }


}

