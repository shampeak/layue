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


    public function articledelete(request $request)
    {
        $id = intval($request->param('id'));
        md('article')->where('id',$id)->delete();
        md('articlecontent')->where('article_id',$id)->delete();
        return [
            'code'=>0,
            'msg'=>'删除完成',
        ];
    }

    public function articleaddnew(request $request)
    {
        $post = trims($request->post());
        $rc['note'] = $post['note'];
        unset($post['note']);
        if(isset($post['file'])) unset($post['file']);
        //添加；
        $post['status'] = isset($post['status'])?intval($post['status']):0;


        $post['createAt'] = time();
        md('article')->insert($post);

        $rc['article_id'] = md('article')->getLastInsID();
        md('articlecontent')->insert($rc);

        return [
            'code'=>0,
            'msg'=>'添加完成',
        ];
    }

    public function articleedit(request $request)
    {
        $post = $request->post();
        $id = $request->post('id');
        $id = intval($id);
//        $rc['article_id'] = $id;
        $rc['note'] = $post['note'];
        unset($post['note']);
        if(isset($post['file'])) unset($post['file']);

        $post['status'] = isset($post['status'])?intval($post['status']):0;
        $post['createAt'] = time();

        md('article')->where('id',$id)->update($post);

        md('articlecontent')->where('article_id',$id)->update($rc);

        return [
            'code'=>0,
            'msg'=>'修改完成',
        ];

    }

    public function articlelist(request $request)
    {

        $page = $request->get('page');
        $limit = $request->get('limit');
        $cid = $request->get('cId');
        $title = $request->get('title');

        $page = $page?:1;
        $limit = $limit?:10;
        $be = ($page-1)*$limit;


        $where[] = '1=1';
        if($cid) $where[] = "cId = $cid";
        if($title) $where[] = "title like '%$title%'";
        $wheres = implode(' and ',$where);

        $list = md('article')->where($wheres)->limit($be,$limit)->select();
        $count = md('article')->where($wheres)->count();

        $category = md('category')->getMap();


        foreach($list as $key=>$value){
            $list[$key]['cId'] = $category[$value['cId']];
        }


        return [
            'code'  => 0,
            'count' => $count,
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