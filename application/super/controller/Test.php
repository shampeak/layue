<?php
namespace app\super\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Test extends Base{

    public function __construct()
    {
        parent::__construct();
    }


    public function index(request $request)
    {

        return view('',[]);
    }

    public function edit(request $request)
    {

        return view('',[
        ]);
    }

    public function addnew(request $request)
    {

        return view('',[
        ]);
    }




}
