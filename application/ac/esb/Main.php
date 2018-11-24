<?php
namespace app\ac\esb;

use think\Model;
use think\Cookie;
use think\Request;

/*
 * 无成本获取环境变量和参数
 */

class Main extends Base{

    public $my;

    public function __construct(){
        //注册所有的ads
        $this->my = esb('my');
    }

    public function getHavenewmessage(){
        return false;
    }


    /*
     * 菜单
     */
    public function getMenu(){
        return [

        ];
    }

    /*
     * 后台title
     */
    public function getHometitle(){
        return 'Sadm std - 后台管理';
    }

    /*
     *后台左上显示的字符
     */
    public function getHomelogochr(){
        return 'Sadm';
    }

    /*
     * 默认的打开页面，console 页面或者welcome页面
     */
    public function getHomeurl(){
        return $this->my['root'];
    }

    /*
     * 用户真实姓名
     */
    public function getTruename(){
        return $this->my['truename'];
    }

    /*
     * 测试调试阶段加载的菜单，调试结束之后去掉
     */
    public function getMenudemo(){
//        return [];
        return @include_once(APP_PATH.'eMenu.php');
    }

    public function getLoginurl(){
        return '/login';
    }

    public function getLogoutjson(){
        return '/main/json/logout';
    }

}

