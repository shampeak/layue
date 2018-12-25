<?php
namespace app\xm\controller;

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


    public function lylist()
    {
    }


    public function khlist(request $request)
    {

        $key = trim($request->get('key'));
        $xmId = $request->get('xmId');
        $where = [];
        if($key){
            $where[] = "`name` like '%$key%'";
        }
        if($xmId){
            $where[] = "xmId = $xmId";
        }

        if($where){
            $_where = implode(' and ',$where);
            $list = md('kh')->where($_where)->select();
        }else{
            $list = md('kh')->select();
        }






        $map = md('xm')->getMap('title','xmId');
        foreach($list as $key=>$value){
            $list[$key]['xmname'] = isset($map[$value['xmId']])?$map[$value['xmId']]:'';
        }

        //项目
        return [
            'code'=>0,
            'msg'=>'完成',
            'data'=>$list
        ];
    }

    public function khdelete(request $request)
    {
        $id = $request->post('id');
        $id = intval($id);
        md('kh')->where('khId',$id)->delete();

        return [
            'code'=>0,
            'msg'=>'完成',
        ];
    }

    public function khedit(request $request)
    {

        $post = trims($request->post());
        $id = $post['khId'];
        $post['enable'] = isset($post['enable'])?$post['enable']:0;
        $post['primary'] = isset($post['primary'])?$post['primary']:0;


        if(empty($post['pwd'])){
            unset($post['pwd']);
        }else{
            $post['pwd'] = ac('password')->getHash($post['pwd']);
        }



        md('kh')->where('khId',$id)->update($post);

        return [
            'code'=>0,
            'msg'=>'完成',
        ];

    }

    public function khaddnew(request $request)
    {
        //name不能重复
        $name = $request->param('name');
        $fin = md('kh')->where('name',$name)->find();
        if($fin){
            return [
                'code'=>10,
                'msg'=>'用户名已经存在，请重新输入',
            ];
        }
        $post = trims($request->post());
        $post['enable'] = isset($post['enable'])?$post['enable']:0;
        $post['primary'] = isset($post['primary'])?$post['primary']:0;


        $post['pwd'] = ac('password')->getHash($post['pwd']);



        md('kh')->insert($post);
        return [
            'code'=>0,
            'msg'=>'添加完成',
        ];

    }



    public function xmlist()
    {
        $list = md('xm')->select();




        return [
            'code'=>0,
            'msg'=>'完成',
            'data'=>$list
        ];
    }

    public function xmdelete(request $request)
    {
        $id = $request->post('id');
        $id = intval($id);
        md('xm')->where('xmId',$id)->delete();
        return [
            'code'=>0,
            'msg'=>'删除完成',
        ];
    }

    public function xmedit(request $request)
    {
        $post = trims($request->post());
        $id = $post['xmId'];
        $post['enable'] = isset($post['enable'])?$post['enable']:0;
        md('xm')->where('xmId',$id)->update($post);



        return [
            'code'=>0,
            'msg'=>'修改完成',
        ];
    }

    public function xmaddnew(request $request)
    {
        //chr不能重复
        $chr = $request->param('chr');
        $fin = md('xm')->where('chr',$chr)->find();
        if($fin){
            return [
                'code'=>10,
                'msg'=>'这个标识已经存在，请重新输入',
            ];
        }
        $post = trims($request->post());
        $post['enable'] = isset($post['enable'])?$post['enable']:0;

        md('xm')->insert($post);
        return [
            'code'=>0,
            'msg'=>'添加完成',
        ];

    }



}