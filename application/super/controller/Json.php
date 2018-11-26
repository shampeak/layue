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