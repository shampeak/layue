<?php
namespace app\main\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Message extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {
        return view('message/index',[]);
    }

}
