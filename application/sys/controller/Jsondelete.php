<?php
namespace app\sys\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Jsondelete extends Base
{

    public function __construct()
    {
        parent::__construct();
    }


    public function role(request $request)
    {
        $id = intval($request->get('id'));
        md('role')->where('roleId',$id)->delete();

        return [
            'code'=>0,
        ];
    }

    public function user(request $request)
    {
        $id = intval($request->get('id'));
        md('user')->where('uId',$id)->delete();

        return [
            'code'=>0,
        ];
    }



}