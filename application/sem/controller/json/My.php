<?php
namespace app\sem\controller\json;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class My extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }


    /*
     * 我的任务组
     */
    public function tasklist(request $request)
    {
        $mid = $request->get('mid');
        $dts = $request->get('dts');
        $_where = [];

        $myid = ac('my')->getUserId();

        $_where[] = "r_campaigndt.cId = sem_cam.cId";
        $_where[] = "sem_cam.uId = ".$myid;

        if($mid){
            $_where[] = "sem_cam.xmId = $mid ";
        }

        //时间限制到今天昨天
        $dtmark      = date("Y-m-d",strtotime("-3 day"));

        $dts = $dts?:date("Y-m-d",strtotime("-1 day"));
        $_where[] = "r_campaigndt.dt > '$dtmark' ";         //条件限制  三天前
        $_where[] = "r_campaigndt.dt = '$dts' ";
//================================================================
        $where = implode(' and ',$_where);
//echo $where;
        $sql = "select
r_campaigndt.*,
sem_cam.*,
r_campaigndt.id as ids,
sem_cam.mediatype as mediatype
from r_campaigndt,sem_cam
where $where
order by r_campaigndt.id desc
limit 100
";

        $list = Db::query($sql);
        $mediamap = \getConfig('MEDIA_TYPE');
        $xmmap = md('semxm')->getmap();
        $zxmmap = md('semzxm')->getmap();
        $zhmap = md('semzh')->getmap('uname','id');

        foreach( $list as $key=>$value){
            $list[$key]['_mediatype'] = $mediamap[$list[$key]['mediatype']];
            $list[$key]['_xmId'] = isset($xmmap[$list[$key]['xmId']])?$xmmap[$list[$key]['xmId']]:'';
            $list[$key]['_zxmId'] = $zxmmap[$list[$key]['zxmId']];
            $list[$key]['_zId'] = $zhmap[$list[$key]['zId']];

            $list[$key]['cost_y']       = $list[$key]['cost'];
            $list[$key]['impression_y'] = $list[$key]['impression'];
            $list[$key]['click_y']      = $list[$key]['click'];
        }


        return [
            'code'=>0,
            'msg'=>'成功',
            'data'=>$list
        ];
    }

    public function updatedate(request $request)
    {
        $id = $request->get('id');
        $field = $request->get('field');
        $value = $request->get('value');
        $row = md('campaigndt')->find($id);
        $row = $row->toArray();
        $row[$field] = $value;


//====================================================================
//计算
        $row['fd']              = round((float)$row['fd'],2);
        $row['cost']            = round((float)$row['cost'],2);
        $row['click']           = (int)$row['click'];
        $row['impression']      = (int)$row['impression'];

        $row['zixun']           = (int)$row['zixun'];
        $row['zhuanhua']        = (int)$row['zhuanhua'];
        $row['liuyan']          = (int)$row['liuyan'];
        //============================================================
        $row['cpc']             = empty($row['click'])?0:round($row['cost']/$row['click'],2);
        $row['ctr']             = empty($row['impression'])?0:round($row['click']/$row['impression'],2);

        $row['zhuanhualv']      = $row['zixun']?round($row['zhuanhua']/$row['zixun'],2):0;
        $row['zongshu']         = $row['zhuanhua'] + $row['liuyan'];
        $row['xingjiabi']       = $row['zongshu']?$row['cost']/$row['zongshu']:0;

        if($row['cost']!=0){
            $row['rmb']= round($row['cost']/(1+$row['fd']),2);
        }else{
            $row['rmb']= 0;
        }
//====================================================================

        //更新
        md('campaigndt')->where('id',$id)->update($row);

        $data = ['rmb'=>$row['rmb']];

        return [
            'code'=>0,
            'data'=>$data,
            'msg'=>'成功',
        ];

    }




}
