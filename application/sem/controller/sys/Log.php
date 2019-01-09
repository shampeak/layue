<?php
namespace app\sem\controller\sys;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Log extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }



    public function index(request $request)
    {

        return view('',[]);
    }

}
