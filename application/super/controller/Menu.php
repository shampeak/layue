<?php
namespace app\super\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Menu extends Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function edit(request $request)
    {
        $id = intval($request->get('id'));
        $row = md('ads')->find($id);
        return view('menu/edit',[
            'row'=>$row
        ]);
    }


    public function addnew(request $request)
    {
        return view('menu/addnew',[]);
    }

    public function index(request $request)
    {
        return view('menu/index',[]);
    }




}
