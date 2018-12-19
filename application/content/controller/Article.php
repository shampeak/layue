<?php
namespace app\content\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Article extends Base{

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

        $row = md('article')->find($id);
//        echo $row['content']['note'];


        return view('',['row'=>$row]);
    }


    public function index(request $request)
    {

        $list = md('article')->select();

        //文章分类
//        foreach($list as $key => $value){
////            echo $value['cat']['title'];
//        }


        //频道管理
        return view('',['list'=>$list]);
    }


}
