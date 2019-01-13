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


    public function dlist(request $request)
    {
        $tree =  [
            [
                'id'=>'1',
                'pid'=>'0',
                'title'=>'10',
            ],
            [
                'id'=>'2',
                'pid'=>'1',
                'title'=>'10',
            ],
            [
                'id'=>'3',
                'pid'=>'2',
                'title'=>'10',
            ],
            [
                'id'=>'11',
                'pid'=>'0',
                'title'=>'10',
            ],
            [
                'id'=>'21',
                'pid'=>'11',
                'title'=>'10',
            ],
            [
                'id'=>'31',
                'pid'=>'21',
                'title'=>'10',
            ],

        ];

        $showhidden = $request->get('showhidden');

//        key     =
//        showhidden  =

        $xmlist = md('semxm')->where('enable',1)->select();

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
                    if($showhidden || $v['enable']) {
                        $res[] = $_value;

                        //========================================
                        //下面的计划
                        if(!empty($v->cam) ){
                            foreach($v->cam as $kk=>$vv){
                                $_value = [
                                    'id' => $value['xmId'].$v['zxmId'].$vv['cId'],
                                    'pid'=> $value['xmId'].$v['zxmId'] ,
                                    'enable'=> $vv['enable'] ,
                                    'tid'=> $vv['cId'] ,
                                    'mediatype'=> $vv['mediatype'] ,
                                    'hand'=> $vv['hand'] ,
                                    'title'=> $vv['cName']
                                ];
                                if($showhidden || $vv['enable']) {
                                    $res[] = $_value;
                                }
                            }
                        }
                        //========================================
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
