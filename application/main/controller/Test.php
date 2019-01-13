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



        $user = md('Semxm')->find(73);
        $ug = $user->zxm;


        print_r($ug);



        exit;
echo 111;

        $user = md('user')->find(1);
        //        $ug = $user->profile;
        $ug = $user->group;
        $ug = $user->groupads;
        print_r($ug);


exit;
echo '================';
        $ug = '';
        $row = md('config')->find(20);
        $rc = $row->form;
        print_r($rc);

        exit;

        $uid = 135;
        $res = ac('user')->setUid($uid)->getProfile();
        print_r($res);
        exit;

    }

    public function eth(request $request)
    {
        return view('./eth',[]);

    }

    public function eth2(request $request)
    {
        return view('./eth2',[]);

    }


}
