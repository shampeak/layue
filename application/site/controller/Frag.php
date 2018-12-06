<?php
namespace app\site\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Frag extends Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function addnew(request $request)
    {
        return view('',[]);
    }

    public function edit(request $request)
    {
        $id = $request->param('id');
        $id = intval($id);
        $row = md('frag')->find($id);

        return view('',['row'=>$row]);
    }


    public function index(request $request)
    {
        $list = md('channel')->select();
        //频道管理
        return view('',['list'=>$list]);
    }


}
