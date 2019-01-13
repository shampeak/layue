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
        $pagesize = $limit?:10;
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
//        echo $_where;
        $page = intval($page);

        $limit = ($page-1)*$limit;
        $list = md('config')->where($_where)->limit($limit,$pagesize)->select();
//        $list = md('config')->where($_where)->select();
//        print_r($list);
        $count =md('config')->where($_where)->count();
        return [
            'code'=>0,
            'count'=>$count,
            'data'=>$list
        ];
        return ['code'=>0];
    }

    public function addnew(request $request)
    {
        $post = $request->post();

        $status = $request->post('status');
        $post['status'] = $status?1:0;

        $name = $request->post('name');
        $find = md('config')->where('name',$name)->find();
        if($find){
            return [
                'code'=>120,
                'msg'=>'标识已经存在'
            ];
        }

        md('config')->insert($post);
        return ['code'=>0];
    }

    public function delete(request $request)
    {
        return ['code'=>0];
    }

    public function edit(request $request)
    {
        $id = (int)$request->post('id');
        $post = $request->post();

        $status = $request->post('status');
        $post['status'] = $status?1:0;


        md('config')->update('id',$id)->update($post);

        return ['code'=>0];
    }


}
