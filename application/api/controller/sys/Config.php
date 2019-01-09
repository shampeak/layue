<?php
namespace app\api\controller\sys;

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

    public function dlist(request $request)
    {
        $page   = $request->get('page');
        $limit  =  $request->get('limit');
        $limit = $limit?:10;
        $key    =  $request->get('key');
        $groupid =  $request->get('groupid');

        $where[] = '1=1';
        if($key){
            $where[] = "name = '$key'";
        }
        if($groupid) {
            $where[] = "`group` = '$groupid'";
        }
        $_where = implode(' and ',$where);
        //echo $_where;
        $list = md('config')->where($_where)->limit($page,$limit)->select();

        return [
            'code'=>0,
            'count'=>120,
            'data'=>$list
        ];
        return ['code'=>0];
    }

    public function addnew(request $request)
    {

        return ['code'=>-190];
    }


    public function delete(request $request)
    {
        return ['code'=>0];
    }

    public function edit(request $request)
    {
        $post = $request->post();



        return ['code'=>0];
    }


}
