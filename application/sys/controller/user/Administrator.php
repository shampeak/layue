<?php
namespace app\sys\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Administrator extends Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {
        return view('administrator/index',[]);
    }

}
