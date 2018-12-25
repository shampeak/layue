<?php
namespace app\main\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Test extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {
        echo '123123123123123123123123123';

        $uid = 135;
        $res = ac('user')->setUid($uid)->getProfile();
        print_r($res);

    }

    public function eth(request $request)
    {
        return view('./eth',[]);

    }


}
