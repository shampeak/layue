<?php
namespace app\sys\controller\user;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Jsonlist extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function group(request $request)
    {

        $list = md('group')->select();


        return [
            'code'=>0,
            'msg'=>'',
            'data'=>$list
        ];
    }




}
