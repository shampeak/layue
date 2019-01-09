<?php
namespace app\sys\controller\platform;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Config extends \app\sys\controller\Base{

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
        $id = (int)$request->get('id');
        $row = md('config')->find($id);
        return view('',[
            'row'=>$row
        ]);
    }



    public function index(request $request)
    {
        return view('',[]);
    }


}
