<?php
namespace app\sys\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Base extends Controller{

    /* @var array $admin 管理员信息 */
    protected $admin;

    /* @var string $route 当前控制器名称 */
    protected $controller = '';

    /* @var string $route 当前方法名称 */
    protected $action = '';

    /* @var string $route 当前路由uri */
    protected $routeUri = '';

    /* @var string $route 当前路由：分组名称 */
    protected $group = '';

    /* @var array $allowAllAction 登录验证白名单 */
    protected $allowAllAction = [
        // 登录页面
        'passport/login',
    ];

    public function __construct()
    {
        parent::__construct();
        //路由信息
        $this->getRouteinfo();
        // 验证登录
        $this->checkLogin();
        //获取用户信息
        $this->admin = ac('my')->getInfo();
        $this->group = ac('my')->getGroup();
        $this->groupads = ac('my')->getGroupAds();

        //注册ads
        ac('ini')->register();

    }

    /**
     * 验证登录状态
     * @return bool
     */
    private function checkLogin()
    {

        // 验证当前请求是否在白名单
        if (in_array($this->routeUri, $this->allowAllAction)) {
            return true;
        }
        // 验证登录状态
        $islogin = ac('auth')->IsLogin();
//        empty($this->admin) ||
        if ( empty($islogin)
        ) {
            $this->redirect('/login');
            return false;
        }

        return true;
    }

    /**
     * 解析当前路由参数 （分组名称、控制器名称、方法名）
     */
    protected function getRouteinfo()
    {

        $this->module = $this->request->module();
        // 控制器名称
        $this->controller = toUnderScore($this->request->controller());
        // 方法名称
        $this->action = $this->request->action();

        // 控制器分组 (用于定义所属模块)
        $groupstr = strstr($this->controller, '.', true);
        $this->group = $groupstr !== false ? $groupstr : $this->controller;

        // 当前uri
        $this->routeUri = $this->controller . '/' . $this->action;
    }

}
