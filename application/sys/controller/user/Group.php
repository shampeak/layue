<?php
namespace app\sys\controller\user;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Group extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }


    public function addnew(request $request)
    {
        return view('',[]);
    }


    public function index(request $request)
    {
        return view('',[]);
    }

    public function edit(request $request)
    {
        $id = $request->get('id');
        $row = md('group')->find($id);
        $fun = md('groupads')->where('groupId',$id)->find();
        //===================================================
        $row = $row?$row->toArray():[];
        $fun = $fun?$fun->toArray():[];
        if($fun){
            $fun['adsIds'] =json_decode( $fun['adsIds']);
        }else{$fun = [];}

        //===================================================
        return view('',[
            'row'=>$row
            ,'fun'=>$fun
        ]);
    }



}
