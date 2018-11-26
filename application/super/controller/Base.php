<?php
namespace app\super\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Base extends Controller{

    public function __construct()
    {
        parent::__construct();
        //role
        $check = esb('role')['check'];
        if(!$check){
            echo '权限错误';
            die();
        }
        ac('ini')->register();
    }

 

}
