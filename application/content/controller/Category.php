<?php
namespace app\content\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Category extends Base{

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
        return view('',[]);
    }

    public function edit(request $request)
    {
        $id = $request->param('id');
        $row = md('category')->find($id);

        return view('',['row'=>$row]);
    }




}
