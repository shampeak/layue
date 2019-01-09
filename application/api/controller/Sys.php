<?php
namespace app\api\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Sys extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function configdelete(request $request)
    {
        return ['code'=>0];
    }

}
