<?php
namespace app\site\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Fview extends Base{

    public function __construct()
    {
        parent::__construct();
    }


    public function index(request $request)
    {

        $list = [];
        $html = $this->fetch('fview/index',$list);
        $html .= "<!-- Refresh at ".date('Y-m-d H:i:s')." -->";
        echo $html;
//        return view('',['list'=>$list]);
    }


}
