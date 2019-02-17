<?php
namespace app\api\controller\sem;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Xmtree extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }


    public function manageuser(request $request)
    {
        $keyword = $request->get('addnewzxmkey');

        $groupidar = getConfig('SEM_GROUPID');
        $grouplimit = implode(',',$groupidar);      //用户组限制

        $groupmap = md('group')->getMap();

        $_where[] = ' 1=1';
        if($keyword){
            $_where[] = "trueName like '%$keyword%'";
        }
        $_where[] = "(groupId in ($grouplimit))";
        $where = implode(' and ',$_where);


        $list = md('user')->where($where)->field('uId,groupId,trueName,enable')->select();
        $count = md('user')->where($where)->field('uId,groupId,trueName,enable')->count();

        foreach($list as $key=>$value){
            $list[$key]['title'] = $value['trueName'];
            $list[$key]['enablechr'] = $value['enable']?'有效':'无效';
            $list[$key]['groupname'] = $groupmap[$value['groupId']];
        }
        return [
            'code'  => 0,
            'count' => $count,
            'data'  => $list
        ];
    }

    /*
     * 复合选择 媒体
     */
    public function mesel(request $request)
    {
        $media = getconfig('MEDIA_TYPE');
        $mediachr = getconfig('MEDIA_TYPE_CHR');

        foreach($media as $key=>$value){
            $vr['mid'] = $key;
            $vr['title'] = $value;
            $vr['chr'] = $mediachr[$key];
            $list[] = $vr;
        }


        return [
            'code'=>0,
            'count'=>count($list),
            'data'=>$list
        ];

    }

    /*
     * 复合选择 用户
     */
    public function ussel(request $request)
    {
        $selkey = $request->get('selkey');
        $page = $request->get('page');
        $limit = $request->get('limit');
        //返回项目列表
        $list = md('user')->where('name','like',"%$selkey%")->limit(($page-1)*$limit,$limit)->select();
        $count = md('user')->where('name','like',"%$selkey%")->limit(($page-1)*$limit,$limit)->count();

        foreach($list as $key=>$value){
            $list[$key]['enablechr'] = $value['enable']?'有效':'无效';
        }

        return [
            'code'=>0,
            'count'=>$count,
            'data'=>$list
        ];

    }
    /*
     * 复合选择 账号
     */
    public function zhsel(request $request)
    {
        $selkey = $request->get('selkey');
        $page = $request->get('page');
        $limit = $request->get('limit');
        //返回项目列表
        $list = md('semzh')->where('uname','like',"%$selkey%")->limit(($page-1)*$limit,$limit)->select();
        $count = md('semzh')->where('uname','like',"%$selkey%")->limit(($page-1)*$limit,$limit)->count();

        foreach($list as $key=>$value){
            $list[$key]['enablechr'] = $value['enable']?'有效':'无效';
        }

        return [
            'code'=>0,
            'count'=>$count,
            'data'=>$list
        ];

    }

    /*
     * 复合选择 项目
     */
    public function xmsel(request $request)
    {
        $selkey = $request->get('selkey');
        $page = $request->get('page');
        $limit = $request->get('limit');
        //返回项目列表
        $list = md('semxm')->where('title','like',"%$selkey%")->limit(($page-1)*$limit,$limit)->select();
        $count = md('semxm')->where('title','like',"%$selkey%")->limit(($page-1)*$limit,$limit)->count();

        foreach($list as $key=>$value){
            $list[$key]['enablechr'] = $value['enable']?'有效':'无效';
        }

        return [
            'code'=>0,
            'count'=>$count,
            'data'=>$list
        ];

    }

    public function dlist(request $request)
    {

        $showhidden = $request->get('showhidden');
        $xmflit     = $request->get('xmflit');
        $media = getConfig('MEDIA_TYPE');


        //项目的
        $_where[] = '1=1';
        if(!$showhidden){
            $_where[] = 'enable = 1';       //不选只显示有效
        }

        //选择部分项目
        if($xmflit){
            $ar = explode(',',$xmflit);
            foreach($ar as $key=>$value){
                $ar[$key] = "'$value'";
            }
            $tj = implode(',',$ar);
            $_where[] = "title in ($tj)";
        }
        $_wherestr = implode(' and ',$_where);

        $xmlist = md('semxm')->where($_wherestr)->order('sort','desc')->select();

        $res = [];
        foreach($xmlist as $key=>$value){
            $_value = [
                'id' => $value['xmId'],
                'pid'=> 0 ,
                'enable'=> $value['enable'] ,
                'tid'=> $value['xmId'] ,
                'title'=> $value['title']
            ];
            $res[] = $_value;
            //========================================
            //下面的子项目
            if(!empty($value->zxm)){
                foreach($value->zxm as $k=>$v){
                    if($showhidden || $v['enable']) {
                        $user = $v->user;
                        $trueName = $user?$user['trueName']:'';
                        $_value = [
                            'id' => $value['xmId'].$v['zxmId'],
                            'pid'=> $value['xmId'] ,
                            'enable'=> $v['enable'] ,
                            'tid'=> $v['zxmId'] ,
                            'uId'=> $v['uId'] ,
                            'uname'=> $trueName ,
                            'xx'=> $v['xx'] ,
                            'title'=> $v['title']
                        ];

                            //========================================
                            //下面的计划
                            if(!empty($v->cam) ){
                                foreach($v->cam as $kk=>$vv){
                                    if($showhidden || $vv['enable']) {
                                        $_value2 = [
                                            'id' => $value['xmId'].$v['zxmId'].$vv['cId'],
                                            'pid'=> $value['xmId'].$v['zxmId'] ,
                                            'enable'=> $vv['enable'] ,
                                            'tid'=> $vv['cId'] ,
                                            'mediatype'=> $vv['mediatype'] ,
                                            'mediatypename'=> $media[$vv['mediatype']] ,
                                            'hand'=> $vv['hand'] ,
                                            'title'=> $vv['cName']
                                        ];
                                        $res[] = $_value2;
                                    }
                                }
                                $_value['count'] = count($v->cam);
                            }else{
                                $_value['count'] = 0;
                            }
                            //========================================
                        $res[] = $_value;

                        }

                }
            }
        }


        $tree = $res;
//额外
        //hand
        //uId
        //mediatype
        //count
        return $tree;
    }

    public function mydlist(request $request)
    {

        $showhidden = $request->get('showhidden');
        $media = getConfig('MEDIA_TYPE');
        $myid = ac('my')->getUserId();

        //项目的
        $_where[] = '1=1';
        if(!$showhidden){
            $_where[] = 'enable = 1';       //不选只显示有效
        }


        //==========================================================
        //项目限定
        if($showhidden){
            $rees = md('semzxm')->where('uid',$myid)->select();
        }else{
            $rees = md('semzxm')->where('enable',1)->where('uid',$myid)->select();
        }

        foreach($rees as $key=>$value){
            $mrs[] = $value['xmId'];
        }

        $strs  = implode(',',$mrs);
        if($strs) $_where[] = "xmId in ($strs)";
        //==========================================================



        $_wherestr = implode(' and ',$_where);
        $xmlist = md('semxm')->where($_wherestr)->order('sort','desc')->select();

        $res = [];
        foreach($xmlist as $key=>$value){
            $_value = [
                'id' => $value['xmId'],
                'pid'=> 0 ,
                'enable'=> $value['enable'] ,
                'tid'=> $value['xmId'] ,
                'title'=> $value['title']
            ];
            $res[] = $_value;
            //========================================
            //下面的子项目
            if(!empty($value->zxm)){
                foreach($value->zxm as $k=>$v){
                    if(($showhidden || $v['enable']) && $v['uId'] == $myid) {

                        $user = $v->user;
                        $trueName = $user?$user['trueName']:'';
                        $_value = [
                            'id' => $value['xmId'].$v['zxmId'],
                            'pid'=> $value['xmId'] ,
                            'enable'=> $v['enable'] ,
                            'tid'=> $v['zxmId'] ,
                            'uId'=> $v['uId'] ,
                            'uname'=> $trueName ,
                            'xx'=> $v['xx'] ,
                            'title'=> $v['title']
                        ];

                        //========================================
                        //下面的计划
                        if(!empty($v->cam) ){
                            foreach($v->cam as $kk=>$vv){
                                if($showhidden || $vv['enable']) {
                                    $_value2 = [
                                        'id' => $value['xmId'].$v['zxmId'].$vv['cId'],
                                        'pid'=> $value['xmId'].$v['zxmId'] ,
                                        'enable'=> $vv['enable'] ,
                                        'tid'=> $vv['cId'] ,
                                        'mediatype'=> $vv['mediatype'] ,
                                        'mediatypename'=> $media[$vv['mediatype']] ,
                                        'hand'=> $vv['hand'] ,
                                        'title'=> $vv['cName']
                                    ];
                                    $res[] = $_value2;
                                }
                            }
                            $_value['count'] = count($v->cam);
                        }else{
                            $_value['count'] = 0;
                        }
                        //========================================
                        $res[] = $_value;

                    }

                }
            }
        }


        $tree = $res;
//额外
        //hand
        //uId
        //mediatype
        //count
        return $tree;
    }

}
