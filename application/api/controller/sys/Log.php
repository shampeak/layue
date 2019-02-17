<?php
namespace app\api\controller\sys;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Log extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }


    public function index(request $request)
    {
        $page = $request->get('page');
        $limit = $request->get('limit');

        //==============================================================
        $list = md('cgilog')->limit(($page-1)*$limit,$limit)->order('id','desc')->select();
        $count = md('cgilog')->count();
        //==============================================================
        return [
            'code'  => 0,
            'count' => $count,
            'data'  => $list
        ];
    }




}
