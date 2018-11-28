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
        return view('index/index',[]);
    }

    public function test(request $request)
    {
        $res = esb('main')['menu'];
        print_r($res);
        exit;
//        return view('index/index',[]);
    }


}
