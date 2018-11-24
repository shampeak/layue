<?php
namespace app\main\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Login extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {

        return view('index/login',[]);
    }

}
