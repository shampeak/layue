<?php
namespace app\sys\controller\user;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class User extends \app\sys\controller\Base{

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
        $id = $request->get('id');
        $row = md('user')->find($id);

        $map = md('group')->getMap();

        return view('',[
            'map'=>$map,
            'row'=>$row
        ]);
    }



}
