<?php
namespace app\site\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Setup extends Base{

    public function __construct()
    {
        parent::__construct();
    }


    public function index(request $request)
    {
        $map = md('config')->where('name','like','%SITE%')->column('*','name');

        return view('',['map'=>$map]);
    }




}
