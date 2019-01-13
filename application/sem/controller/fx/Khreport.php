<?php
namespace app\sem\controller\fx;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Khreport extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }



    public function index(request $request)
    {

        return view('',[]);
    }

}
