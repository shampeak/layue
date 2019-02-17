<?php
namespace app\api\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Demo{

    public function __construct()
    {
//        parent::__construct();
    }

    public function index(request $request)
    {
        return ['code'=>0];
    }

    public function edit(request $request)
    {
        return ['code'=>0];
    }

    public function delete(request $request)
    {
        return ['code'=>0];
    }

    public function dlist(request $request)
    {

//        测试数据，不i要当真
        $list = md('user')->select();
        $count = count($list);


        return [
            'code'  => 0,
            'count' => $count,
            'data'  => $list
        ];
    }



}
