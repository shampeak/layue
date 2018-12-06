<?php
namespace app\main\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Lists extends Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {

        $list = [
            '通用' => [
                [
                    'title' => '面板',
                    'url'   => '/main/console',
                    'state'=> '完成',
                ],
                [
                    'title' => '修改密码',
                    'url'   => '/sys/my.password/index',
                    'state'=> '完成',
                ],
                [
                    'title' => '修改资料',
                    'url'   => '/sys/my.info/index',
                    'state'=> '完成',
                ],
            ],
            '超级设置' => [
                [
                    'title' => 'Ads管理',
                    'url'   => '/super/ads/index',
                    'state'=> '完成',
                ],
                [
                    'title' => '菜单管理',
                    'url'   => '/super/menu/index',
                    'state'=> '完成',
                ],
            ],
            '用户' => [
                [
                    'title' => '角色管理',
                    'url'   => '/sys/user.group/index',
                    'state'=> '完成',
                ],
                [
                    'title' => '用户管理',
                    'url'   => '/sys/user.user/index',
                    'state'=> '完成',
                ],
            ],
            '站点管理' => [
                [
                    'title' => '模板管理',
                    'url'   => '/site/page/index',
                    'state'=> '完成',
                ],
                [
                    'title' => '碎片管理',
                    'url'   => '/site/frag/index',
                    'state'=> '完成',
                ],
                [
                    'title' => '站点设置',
                    'url'   => '/site/setup/index',
                    'state'=> '完成',
                ],
                [
                    'title' => '频道管理',
                    'url'   => '/site/channel/index',
                    'state'=> '完成',
                ],
            ],
            '内容管理' => [
                [
                    'title' => '分类管理',
                    'url'   => '/content/category/index',
                    'state'=> '完成',
                ],
                [
                    'title' => '文章管理',
                    'url'   => '/content/article/index',
                    'state'=> '完成',
                ],
            ],
        ];
        return view('',['list'=>$list]);
    }


}
