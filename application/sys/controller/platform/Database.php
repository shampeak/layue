<?php
namespace app\sys\controller\platform;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Database extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {
        return view('',[]);
    }


}
