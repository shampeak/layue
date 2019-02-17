<?php
namespace app\sem\controller\mans;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class User extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }


    public function groupedit(request $request)
    {
//        $md = \think\Config::get('semgroup');
//echo $md;
        //===========================================
        return view('',[]);

    }

    public function group(request $request)
    {
        //===========================================
        return view('',[]);
    }

    public function panel(request $request)
    {
        //===========================================
        return view('',[]);
    }



}
