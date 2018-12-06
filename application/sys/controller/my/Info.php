<?php
namespace app\sys\controller\my;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Info extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {
        $info = ac('my')->getinfo();


        return view('',[
            'info'=>$info
        ]);
    }




}
