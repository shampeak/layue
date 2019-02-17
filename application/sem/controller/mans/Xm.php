<?php
namespace app\sem\controller\mans;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Xm extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {

        return view('',[]);
    }



    public function addnewxm(request $request)
    {
        //=======================================
        //键值字典
        $mediachr = getconfig('MEDIA_TYPE_CHR');
        $media = getconfig('MEDIA_TYPE');
        $nam['baidu1'] = '百度信息流';
        foreach($mediachr as $key=>$value){
            $nam[$value] = $media[$key];
        }
        //获得nam
        //=======================================
        return view('',[
            'nam'=>$nam
        ]);
    }

    public function addnewxmpost(request $request)
    {
        $post = $request->post();
        $fd = $post['fd'];

        foreach($fd as $key=>$value){
//            $fd[$key] = intval($value)/100;
            $nsar[] = $key.':'.intval($value)/100;
        }
        $str = implode("\n",$nsar);
        $post['fd'] = $str;
        md('semxm')->insert($post);

        return [
            'code'=>0
        ];
    }

    public function addnewzxm(request $request)
    {
        $id = (int)$request->get('id');
        $xm = md('semxm')->find($id);
        return view('',['xm'=>$xm]);
    }

    public function addnewzxmpost(request $request)
    {
//xmId:67
//title:123
//xx:0
//uId:杨2
//cam[16]:99001416
//dis:
//sort:0
//enable:1

        $post = $request->post();
        $cam = $post['cam'];
        $uname = $post['uname'];

        unset($post['cam']);
        unset($post['uname']);

        //计算uId
        $urow = md('user')->where('trueName',$uname)->find();
        $post['uId'] = $urow?$urow['uId']:0;

        md('semzxm')->insert($post);

        $zxmid = md('semzxm')->getLastInsID();
        //处理cam
        if($cam){
            foreach($cam as $key=>$cId){
                $rc['xmId'] = $post['xmId'];
                $rc['zxmId'] = $zxmid;
                $rc['uId'] = $post['uId'];
                md('semcam')->where('cId',$cId)->update($rc);
            }
        }
        return [
            'code'=>0
        ];
    }

    //==================================

    public function editxm(request $request)
    {
        //=======================================
        //键值字典
        $mediachr = getconfig('MEDIA_TYPE_CHR');
        $media = getconfig('MEDIA_TYPE');
        $nam['baidu1'] = '百度信息流';
        foreach($mediachr as $key=>$value){
            $nam[$value] = $media[$key];
        }
        //获得nam
        //=======================================
        $id = $request->get('id');
        $id = intval($id);
        $row = md('semxm')->find($id);

        //计算返点
        //=======================================
        //键值字典
        $ar = [];
        $_fd = $row['fd'];
        $_ar = explode("\n",$_fd);
        foreach($_ar as $key=>$value) {
            $_value = str_replace('：', ':', $value);
            $ar2 = explode(":", $_value);
            if(count($ar2)==2){
                $ar[$ar2[0]] = $ar2[1]*100;
            }
        }
//        print_R($nam);
//        print_R($ar);

        return view('',[
            'nam'=>$nam,
            'row'=>$row,
            'ar'=>$ar,
        ]);
    }

    public function editxmpost(request $request)
    {
        $post = $request->post();
        $fd = $post['fd'];
        $xmid = $post['xmId'];
        foreach($fd as $key=>$value){
//            $fd[$key] = intval($value)/100;
            $nsar[] = $key.':'.intval($value)/100;
        }
        $str = implode("\n",$nsar);
        $post['fd'] = $str;
        md('semxm')->where('xmId',$xmid)->update($post);
        return [
            'code'=>0
        ];
    }

    public function editzxm(request $request)
    {
        $id = (int)$request->get('id');
        $row = md('semzxm')->find($id);
        return view('',['row'=>$row]);
    }

    public function editzxmpost(request $request)
    {

        $post = $request->post();
        $cam = $post['cam'];
        $uname = $post['uname'];

        unset($post['cam']);
        unset($post['uname']);

        //===========================================
        //计算uId
        $urow = md('user')->where('trueName',$uname)->find();
        $post['uId'] = $urow?$urow['uId']:0;

        //更新zxm记录
        md('semzxm')->where('zxmId',$post['zxmId'])->update($post);

        //===========================================
        //处理cam
        //首先重置记录
        $zxmid = $post['zxmId'];
        $zero['xmId'] = 0;
        $zero['zxmId'] = 0;
        $zero['uId'] = 0;
        md('semcam')->where('zxmId',$zxmid)->update($zero);
        if($cam){
            foreach($cam as $key=>$cId){
                $rc['xmId'] = $post['xmId'];
                $rc['zxmId'] = $zxmid;
                $rc['uId'] = $post['uId'];
                md('semcam')->where('cId',$cId)->update($rc);
            }
        }

        return [
            'code'=>0
        ];
    }


    public function addnewcam(request $request)
    {
        //判断一定要选择账户

        $id = (int)$request->get('id');         //子项目的id
        //===========================================
        $zxm = md('semzxm')->find($id);
        //===========================================
        return view('',['zxm'=>$zxm]);
    }

    public function addnewcampost(request $request)
    {
        $zid = $request->post('zId');
        $post = $request->post();
        if(!$zid){
            return [
                'code'=>10,
                'msg'=>'请选择账户'
            ];
        }

        //补全信息
//        $post['xmId'] = 0;
//        $post['zxmId'] = 0;
//        $post['uId'] = 0;

        //计算cId

        $db = md('semcam');



        $db->xmId   = $post['xmId'];
        $db->zxmId  = $post['zxmId'];
        $db->cName  =$post['cName'];
        $db->uId    = $post['uId'];
        $db->mediatype =$post['mediatype'];
        $db->zId    =$post['zId'];
        $db->enable = $post['enable'];
        $db->hand =1;
        $db->save();

        $db->cId = $db->id;

        $db->save();


        return [
            'code'=>0,
            'msg'=>'完成'
        ];
    }


    public function editcam(request $request)
    {
//      $user = md('semcam')->find(1025);
//      $ug = $user->zxm;
////      $ug = $user->zh;
////      $ug = $user->user;
////      $ug = $user->xm;
//      print_r($ug);
//


        //===========================================
        return view('',[]);

    }

    public function editcampost(request $request)
    {
        $post = $request->post();

        $id = $post['id'];

        $res['cName'] =$post['cName'];
        $res['mediatype'] =$post['mediatype'];
        $res['zId'] =$post['zId'];
        $res['enable'] = $post['enable'];

        md('semcam')->where('id',$id)->update($res);


        return [
            'code'=>0,
            'msg'=>'完成'
        ];
    }


}
