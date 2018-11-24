<?php
namespace app\example\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Index extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {
        //================================================
//        //动作判断拦截
//        if($request->isPost()){
//            $action = $request->action().'Post';
//            return $this->$action($request);
//        }
//        //================================================
//
//        $post = trims($request->post());
//        $validate   = Loader::validate('Indextest');

        $list = [
            'page'=>'/example/index/page',
            '文字'=>'/example/index/wz',
            '数组'=>'/example/index/arr',
            'event'=>'/example/index/event',
            'md'=>'/example/index/md',
            'esb'=>'/example/index/esb',
        ];


        return view('index/index',[
            'list' => $list
        ]);
    }

    public function esb(request $request)
    {
        echo 'esb示例';
        $esb = esb();
        $dt = esb('dt');        //调用对方，方式一
        $dt = esb()['dt'];      //调用对象 方式二

        $res = $dt['All'];      //调用方法
        $res = $dt->getAll(1);  //调用方法

        //================================
        $res = $dt['All']=999;      //结果重置
        $res = $dt['All'];
        print_r($res);
    }

    public function ac(request $request)
    {
        $event = ac('ini')->run();
    }


    public function md(request $request)
    {
        $event = md('Test')->run();
    }

    public function event(request $request)
    {
        $event = event('Test')->run();
    }

    public function page(request $request)
    {
        return view('index/page',[
        ]);
    }

    public function wz(request $request)
    {
        return 'wenzi';
    }

    public function arr(request $request)
    {
        return [
            'code'  => 200,
            'msg'   => "wancheng"
        ];
    }

}
