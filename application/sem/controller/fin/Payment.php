<?php
namespace app\sem\controller\fin;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Payment extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function cz(request $request)
    {
        return view('',[
        ]);
    }

    public function xf(request $request)
    {
        return view('',[
        ]);
    }

    public function dmonth(request $request)
    {
//项目 月
//里面是细节
//月规划 最早的到这个月
//所有的项目
//================================================

        $xmflit = $request->get('xmflit');
        $dts = $request->get('dts');
        //=============================================
        $_where[] = "1=1";
        if($xmflit){
            $_where[] = "xmId in($xmflit)";
        }
        if(!empty($dts)){
            $____dtar = explode('~',$dts);
            $dt0 = $____dtar[0];
            $dt1 = $____dtar[1];
            //=============================================
        }else{
            $dt0 = $dt1 = date('Y-m');
        }
        $_where[] = "date_format(dt, '%Y-%m') between '$dt0' and '$dt1'";
        $datearr = [];

        //月份索引
        $dtindex = getMonthIndex($dt0,$dt1);                            //月份索引
//        print_r($dtindex);

        //项目索引
        if($xmflit){
            $xmlist = md('semxm')->where('enable',1)->where('xmId','in',$xmflit)->select();
        }else{
            $xmlist = md('semxm')->where('enable',1)->select();
        }

        foreach($xmlist as $key=>$value){
            $index0 = [];
            foreach($dtindex as $k=>$v){
                $map[$value['xmId']][$v] = 1;
                $index0[] = $v;
            }
        }

        //=======================================================
        return view('',[
            'map'   => $map,
            'index0'=> $index0
        ]);
    }

}
