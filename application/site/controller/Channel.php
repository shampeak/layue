<?php
namespace app\site\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Channel extends Base{

    public function __construct()
    {
        parent::__construct();
    }


    public function index(request $request)
    {
        $list = md('channel')->select();
        //频道管理
        return view('',['list'=>$list]);
    }

    public function addnew(request $request)
    {
        return view('',[]);
    }

    public function edit(request $request)
    {
        $id = $request->param('id');
        $row = md('channel')->find($id);

        return view('',['row'=>$row]);
    }




}
