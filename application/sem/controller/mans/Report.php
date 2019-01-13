<?php
namespace app\sem\controller\mans;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Report extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }



    public function index(request $request)
    {

        return view('',[]);
    }
    public function de(request $request)
    {

        return view('',[]);
    }

}
