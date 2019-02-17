<?php
namespace app\sem\controller\sys;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Zh extends \app\sys\controller\Base{

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
        $id = $request->get('id');
        return view('',[
            'row'=>md('semzh')->find($id)
        ]);
    }

    public function fd(request $request)
    {
        $id = $request->get('id');

        return view('',[
            'row'=>md('semzh')->find($id)
        ]);
    }



    public function index(request $request)
    {

        return view('',[]);
    }

    public function showapi(request $request)
    {
        $id = intval($request->get('id'));
        $ob = new \task\baidu\Baidurun();
        echo $ob->connectTest($id);
        //显示连接的测试信息

        exit;
        return view('',[]);
    }

}
