<?php
namespace app\main\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Index extends Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {
//        //================================================
//        //动作判断拦截
//        if($request->isPost()){
//            $action = $request->action().'Post';
//            return $this->$action($request);
//        }
//        //================================================
//
//        $post = trims($request->post());
//        $validate   = Loader::validate('Indextest');


        //return view('index/index',[]);
    }




}
