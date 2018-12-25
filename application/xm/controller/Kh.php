<?php
namespace app\xm\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Kh extends Base{

    public function __construct()
    {
        parent::__construct();
    }


    public function index(request $request)
    {
        return view('',[]);
    }

    public function addnew(request $request)
    {
//        echo '添加客户';
        return view('',[]);
    }

    public function edit(request $request)
    {

        $id = $request->param('id');
        //echo '编辑用户';
        $row = md('kh')->find($id);
        return view('',['row'=>$row]);
    }



}
