<?php
namespace app\super\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Api extends Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {
        return view('',[]);
    }

    public function detail(request $request)
    {
        return view('',[]);
    }
    public function defaultdetail(request $request)
    {
        return view('',[]);
    }



}
