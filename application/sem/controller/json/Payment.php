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



    public function yeedit(request $request)
    {
        $rmb = $request->post('rmb');
        $balance = $request->post('balance');
        $xmid = $request->post('xmid');
        $_dt = $request->post('dt');
        $dt = $_dt.'-01';
        //=================================================================
        //获取到时间
        $dtn = date("Y-m-d",strtotime("+1 months",strtotime($dt))-24*60*60);            //最后一天的日期


        if(!empty($xmid)  && !empty($dtn) ){
            //=================================================================
            //删除该月份的数据
            $sql = "delete from r_paymentuserdc where xmId = $xmid and date_format(dt, '%Y-%m') = '$_dt'";
            Db::query($sql);
            //添加新的数据
            $rc['dt']       = $dtn;
            $rc['rmb']      = $rmb;
            $rc['balance']  = $balance;
            $rc['xmId']     = $xmid;
            md('paymentuserdc')->insert($rc);
        }

        return [
            'code'=>0,
            'msg'=>'成功',
        ];
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
        $sql = "select date_format(dt, '%Y-%m') as _dt,xmId from r_paymentuser where $where group by _dt,xmId";
        $sql2 = "select date_format(dt, '%Y-%m') as _dt,xmId from r_paymentuserdc where $where group by _dt,xmId";
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
