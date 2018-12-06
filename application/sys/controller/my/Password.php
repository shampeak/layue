<?php
namespace app\sys\controller\my;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Password extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {
        return view('',[]);
    }





}
