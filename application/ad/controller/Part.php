<?php
namespace app\ad\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Part extends Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {
        echo 'prt';
        //增加 删除 修改 配置
        //return view('index/index',[]);
    }




}
