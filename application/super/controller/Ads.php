<?php
namespace app\super\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Ads extends Base{

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
        $id = intval($request->get('id'));
        $row = md('ads')->find($id);
        return view('ads/edit',[
            'row'=>$row
        ]);
    }




}
