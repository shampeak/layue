<?php
namespace app\ad\controller;

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


    public function mainadedit(request $request)
    {
        $aid = intval($request->param('aId'));
        $post = trims($request->post());
        md('ad')->where('aId',$aid)->update($post);
        return [
            'code'=>0,
            'msg'=>'完成',
        ];
    }

    /*
     * //=============================================================
     * ///////////////////////////////////////////////////////////////
     * //=============================================================
     *
     * 下面是示例,要删除调
     *
     *
     * //=============================================================
     * ///////////////////////////////////////////////////////////////
     * //=============================================================
     */
    //todo
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

    public function xmedit()
    {
        return [
            'code'=>0,
            'msg'=>'删除完成',
        ];
    }

    public function xmaddnew()
    {
        return [
            'code'=>0,
            'msg'=>'删除完成',
        ];
    }



}