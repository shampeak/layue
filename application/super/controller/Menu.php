<?php
namespace app\super\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Menu extends Controller{

    public function __construct()
    {
        parent::__construct();
    }


    public function index(request $request)
    {
        return view('index/index',[]);
    }




}
