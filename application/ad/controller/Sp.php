<?php
namespace app\ad\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Sp extends Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {
        return view('',[]);
    }




}