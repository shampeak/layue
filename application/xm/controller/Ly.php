<?php
namespace app\xm\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Ly extends Base{

    public function __construct()
    {
        parent::__construct();
    }


    public function index(request $request)
    {
        return view('',[]);
    }



}
