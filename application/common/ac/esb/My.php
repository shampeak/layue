<?php
namespace app\common\ac\esb;

use think\Model;
use think\Cookie;
use think\Request;

/*
 * 无成本获取环境变量和参数
 */

class My extends Base{

    public function __construct(){
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
    function getInfo(){
        return [];
    }

    function getTruename(){
        return 'Sham';
    }

    function getUid(){
        return '';
    }

    function getRole(){
        return '';
    }

    function getRoot(){
        return '/main/console';
    }

}

