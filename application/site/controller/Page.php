<?php
namespace app\site\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Page extends Base{

    public function __construct()
    {
        parent::__construct();
    }




    public function index(request $request)
    {
        $list = md('channel')->select();
        //频道管理
        return view('',['list'=>$list]);
    }

    public function makeindex(request $request)
    {
        $targetfile =  ROOT_PATH.'public'.DS.'index.html';
        //=======================================
        ob_start();

            //获取内容
            $event = \think\Loader::controller('app\site\controller\Fview');
            $event->index($request);
            //获取内容结束

            $html = ob_get_contents();
            file_put_contents($targetfile, $html);

        ob_end_clean();
        //=======================================
        echo '生成首页 '.date('Y-m-d H:i:s');
        echo '<hr>';
        echo '<a href="/">查看</a>';
    }

}
