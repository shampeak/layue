<?php
namespace app\super\controller;

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



    public function menueditads(request $request)
    {
        $post = $request->post();
        $adsid = intval($post['adsId']);
        $post['hidden'] = isset($post['hidden'])?1:0;
        $post['enable'] = isset($post['enable'])?1:0;
        $post['menulevel'] = isset($post['menulevel'])?1:0;
        md('Ads')->where('adsId',$adsid)->update($post);
        return [
            'code'  => 0,
            'msg'   => '更新完成'
        ];
    }


    public function menueditfun(request $request)
    {
        $post = $request->post();
        $id = intval($post['Id']);
        $f = isset($post['f'])?$post['f']:[];
        //重置
        $res['pId'] = 0;
        md('ads')->where('pId',$id)->update($res);
        //重新赋值
        if($f){
            foreach($f as $k=>$v){
                $res['pId'] = $id;
                md('ads')->where('adsId',$k)->update($res);
            }
        }
        return [
            'code'  => 0,
            'msg'   => '更新完成'
        ];
    }


    public function menuaddnew(request $request)
    {
        $post = trims($request->post());
        $post['enable'] = isset($post['enable'])?1:0;
        $post['hidden'] = isset($post['hidden'])?1:0;

        if(isset($post['f'])){
            $f = $post['f'];
            unset($post['f']);
        }else{
            $f = [];
        }
        //===================================================


        if(!$post['title']){
            return [
                'code'  => 100,
                'msg'   => '请填写名称'
            ];
        }

        //===================================================
        md('Adsindex')->insert($post);
        //下级菜单目录
        if($f){
            $id = Db::getLastInsID();
            //clear
            foreach($f as $key=>$value){
                $res['pId'] = $id;
                md('ads')->where('adsId',$key)->update($res);
            }
        }

        return [
            'code'  => 0,
            'msg'   => '添加完成'
        ];
    }

    public function menuedit(request $request)
    {
        $post = $request->post();
        $adsid = intval($post['Id']);
        $post['hidden'] = isset($post['hidden'])?1:0;
        md('Adsindex')->where('Id',$adsid)->update($post);
        return [
            'code'  => 0,
            'msg'   => '更新完成'
        ];
    }

    public function menudelete(request $request)
    {
        //==========================================
        //
        //==========================================
        $id = intval($request->get('id'));
        md('Adsindex')->where('id',$id)->delete();

        return [
            'code'  => 0,
            'msg'   => '删除Menu完成'
        ];
    }







    public function adsedit(request $request)
    {
        $post = $request->post();
        $adsid = intval($post['adsId']);
        $post['hidden'] = isset($post['hidden'])?1:0;
        $post['enable'] = isset($post['enable'])?1:0;
        $post['menulevel'] = isset($post['menulevel'])?1:0;
        md('Ads')->where('adsId',$adsid)->update($post);
        return [
            'code'  => 0,
            'msg'   => '更新完成'
        ];
    }


    public function adsdelete(request $request)
    {
        //==========================================
        //
        //==========================================
        $id = intval($request->get('id'));
        md('Ads')->where('adsId',$id)->delete();

        return [
            'code'  => 0,
            'msg'   => '删除Ads完成'
        ];
    }

    public function adslist(request $request)
    {
        //==========================================
        //
        //==========================================
        $key = $request->get('key');
        if($key){
            $where = "ads like '%$key%'";
        }else{
            $where = "1=1";
        }
        $list = md('Ads')->where($where)->select();
        $count = md('Ads')->where($where)->count();
        return [
            'code'  => 0
            ,"msg"  => ""
            ,"count"=> $count
            ,"data" => $list
        ];
        return $list;
    }



}