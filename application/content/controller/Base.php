<?php
namespace app\content\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Base extends Controller{

    public function __construct()
    {
        parent::__construct();
        //role
        $check = esb('role')['check'];
        if(!$check){
            echo '权限错误';
            die();
        }
        ac('ini')->register();
    }

    /**
     * 解析当前路由参数 （分组名称、控制器名称、方法名）
     */
    protected function getRouteinfo()
    {

        // 控制器名称
        $this->controller = toUnderScore($this->request->controller());


//        // 方法名称
        $this->action = $this->request->action();

//        // 控制器分组 (用于定义所属模块)
        $groupstr = strstr($this->controller, '.', true);
        $this->group = $groupstr !== false ? $groupstr : $this->controller;
//        // 当前uri
//        $this->routeUri = $this->controller . '/' . $this->action;
    }


}
