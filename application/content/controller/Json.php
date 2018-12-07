<?php
namespace app\content\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Json extends Base
{

    public function __construct()
    {
        parent::__construct();
    }



    public function articlelist(request $request)
    {
        $list = md('article')->select();



        return [
            'code'  => 0,
            'count' => 100,
            'data'  => $list,
        ];

    }

    public function categoryedit(request $request)
    {
        $post = $request->post();
        $post['hidden'] = isset($post['hidden'])?intval($post['hidden']):0;
        md('category')->where('cId',$post['cId'])->update($post);

        return [
            'code'=>0,
            'msg'=>'操作完成',
        ];
    }

    public function categorydelete(request $request)
    {
        $id = $request->param('id');
        md('category')->where('cId',$id)->delete();
        return [
            'code'=>0,
            'msg'=>'删除完成',
        ];
    }

    public function categoryaddnew(request $request)
    {

        $res = $request->post();
        $post['hidden'] = isset($post['hidden'])?intval($post['hidden']):0;

        //字符不能重复    todo
        $chr = $res['chr'];

        md('category')->insert($res);
        return [
            'code'=>0,
            'msg'=>'添加完成',
        ];
    }


    public function categorylist(){
        $list = md('category')->select();
        return [
            'code'=>0,
            'msg'=>'完成',
            'data'=>$list
        ];
    }


}