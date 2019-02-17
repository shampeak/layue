<?php
namespace app\sem\controller\json;

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


    public function dmonth(request $request)
    {
        //=============================================
//        $page = $request->get('page');
//        $limit = $request->get('limit');
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
        //项目索引
//print_r($dtindex);


//        $datearr   //日期索引数组
//        print_r($datearr);
        //=============================================
        $where = implode(' and ',$_where);

        //先建立索引
        $sql = "select date_format(dt, '%Y-%m') as _dt,xmId from f_paymentuser where $where group by _dt,xmId";
        $sql2 = "select date_format(dt, '%Y-%m') as _dt,xmId from f_paymentuserdc where $where group by _dt,xmId";
        $mdr = Db::query($sql);
        $mdr2 = Db::query($sql2);

        //数组合并


        //获得 矩阵


//print_r($_where);



        $list = [];

        return [
            'code'=>0,
            'msg'=>'成功',
            'data'=>$list
        ];
    }





}
