<?php
namespace app\index\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Index extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {

       // return view('index/index',[]);
    }


}
