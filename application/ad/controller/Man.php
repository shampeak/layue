<?php
namespace app\ad\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Man extends Base{

    public function __construct()
    {
        parent::__construct();
    }


    public function edit(request $request)
    {
        return view('',[]);
    }

    public function index(request $request)
    {
        $posid = intval($request->get('posid'));
        if($posid>1)die('pos error');
        //==================================================
        //限制id范围
        //==================================================






        $file = "man/index$posid";
        return view($file,[]);
    }




}
