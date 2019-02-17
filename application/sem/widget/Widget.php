<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/10/19
 * Time: 11:02
 */
namespace app\sem\widget;

use think\Controller;
use think\Db;

class Widget extends Controller
{
    public function xmdt($xmid,$dt)
    {

        //=======================================================
        //项目信息
        $xm = md('semxm')->where('xmId',$xmid)->find();

        //=======================================================
        //1 充值金额
        $_where = "date_format(dt, '%Y-%m') = $dt and xmId = $xmid";
        $cz = md('paymentuser')->where($_where)->select();

        //end 1
        //=======================================================

        //=======================================================
        //2 消费数据
        //1 ： 搜索消费

        //充值数据
        $cz = $this->getCz($xmid,$dt);

        //消费cam
        $list = $this->getXfcam($xmid,$dt);
        if($list){
            $xfcam = $list[0]['sumrmb'];
        }else{
            $xfcam = 0;
        }

        //记录消费
        $list = $this->getXfkf($xmid,$dt);
        if($list){
            $xfkf = $list[0]['rmb'];
            $balance = $list[0]['balance'];

        }else{
            $xfkf = 0;
            $balance = 0;
        }


        //=========================================
        //yue
        $yue = $this->getYe($xmid,$dt);




        return $this->fetch('widget/xmdt',[
            'xmId'=>$xmid,
            'dt'=>$dt,

            //充值
            'cztotal'   => round($cz['total'],2),            //总数据
            'czdctotal' => round($cz['dctotal'],2),          //打款充值
            'czxttotal' => round($cz['xttotal'],2),          //月底对冲
            'phtotal' => round($cz['phtotal'],2),          //系统对冲

            'xfcam'     => $xfcam,          //消费cam
            'xfkf'      => $xfkf,          //消费kf
            'balance'   => $balance,         //本期余额
            'yue'       => $yue             //上期余额
        ]);
    }


    //根据cam获取消费
    public function getXfcam($xmid,$dt)
    {
        $sql = "select sem_cam.xmId,sum(rmb) as sumrmb
from r_campaigndt,sem_cam
where r_campaigndt.cId = sem_cam.cId and sem_cam.xmId = $xmid and date_format(r_campaigndt.dt, '%Y-%m') = '$dt'
group by xmId
";
        $list = Db::query($sql);
        return $list;
    }

    //根据填写的数据获取消费
    public function getXfkf($xmid,$dt)
    {
//        return 0;
        $sql = "select * from f_paymentuserdc
where xmId = $xmid
and date_format(dt, '%Y-%m') = '$dt'
order by dt desc,puId desc limit 1";
//        echo $sql;
        $list = Db::query($sql);
        return $list;
    }


    //=======================================================
    //1 获取 充值和对冲数据
    public function getCz($xmid,$dt){
        //=======================================================
        //1 充值金额
        $_where = "date_format(dt, '%Y-%m') = '$dt' and xmId = $xmid";
        $cz = md('paymentuser')->where($_where)->select();

        $res['total'] = 0;
        $res['dctotal'] = 0;             //打款充值
        $res['xttotal'] = 0;             //系统对冲
        $res['phtotal'] = 0;             //系统对冲
        //end 1
        //=======================================================

        foreach($cz as $key=>$value){
            $res['total'] += $value['rmb'];
            if($value['type']==0){
                $res['dctotal'] += $value['rmb'];
            }
            if($value['type']==9) {
                $res['xttotal'] += $value['rmb'];
            }
            if($value['type']==8) {
                $res['phtotal'] += $value['rmb'];
            }
        }

        return $res;
    }

    //=======================================================
    //1 获取上期个月
    public function getYe($xmid,$dt)
    {
        $dt = date("Y-m", strtotime("-1 months", strtotime($dt)));
        $list =  $this->getXfkf($xmid,$dt);
        if($list){
            return $list[0]['balance'];
        }else{
            return 0;
        }
    }















}


