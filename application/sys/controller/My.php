<?php
namespace app\sys\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class My extends Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {


//        $post = trims($request->post());
//        $validate   = Loader::validate('Indextest');


        //return view('index/index',[]);
    }



    public function avatar(){

        return view('my/avatar',[]);
    }

    public function info(){

        return view('my/info',[]);
    }

    public function password(){

        return view('my/password',[]);
    }




}
