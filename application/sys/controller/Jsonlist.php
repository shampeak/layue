<?php
namespace app\sys\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Jsonlist extends Base
{

    public function __construct()
    {
        parent::__construct();
    }

    public function role(request $request)
    {
        $list = md('role')->order('sort','desc')->select();
        return [
            'code'=>0,
            'data'=>$list
        ];
    }



}