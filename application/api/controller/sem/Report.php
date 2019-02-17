<?php
namespace app\api\controller\sem;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Report extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }


/*
page:1
limit:10
xmflit:豪门盛宴
zhflit:招商帮传媒71
usflit:111
meflit:baidu
dts:2019-01-01 ~ 2019-02-28
reporttemp:1
*/
    public function mydlist(request $request)
    {
        // $get = $request->get();
        //=============================================
        $page = $request->get('page');
        $limit = $request->get('limit');
        $xmflit = $request->get('xmflit');
        $zhflit = $request->get('zhflit');
        $usflit = $request->get('usflit');
        $meflit = $request->get('meflit');
        $dts = $request->get('dts');
        $preporttemp = $request->get('reporttemp');
        //=============================================
        if($xmflit){
            $_where[] = "sem_cam.xmId in($xmflit)";
        }
        if($zhflit){
            $zar = explode(',',$zhflit);
            $zmap = md('semzh')->getMap('id','uname');

            //=======in 查询==============================
            $_w = [];
            foreach($zar as $k=>$v){
                $_w[] = "'$zmap[$v]'";
            }
            $_wrstr = implode(',',$_w);
            $_where[] = "sem_cam.zId in($_wrstr)";
            //===========================================

        }
            //用户限定
            $myid = ac('my')->getUserId();
            $_where[] = "sem_cam.uId = $myid";
            //===========================================

        if($meflit){
            $mediachr = getconfig('MEDIA_TYPE_CHR');
            $mediachr_ =  array_flip($mediachr);

            $mediachrarr = explode(',',$meflit);

            //=======in 查询==============================
            $_w = [];
            foreach($mediachrarr as $k=>$v){
                $_w[] = "'$mediachr_[$v]'";
            }
            $_wrstr = implode(',',$_w);
            $_where[] = "sem_cam.mediatype in($_wrstr)";
            //===========================================

//            //=======or 查询===== in 和都可以用================
//            foreach($mediachrarr as $k=>$v){
//                $_w[] = "sem_cam.mediatype = {$mediachr_[$v]}";
//            }
//            $_wrstr = implode(' or ',$_w);
//            $_where[] = "($_wrstr)";
//            //================================================

        }
        if($dts){
            $dtsar = explode('~',$dts);
            $dtsar[0] = trim($dtsar[0]);
            $dtsar[1] = trim($dtsar[1]);
            $_where[] = "r_campaigndt.dt between '{$dtsar[0]}' and '{$dtsar[1]}'";
        }

        $_where[] = "r_campaigndt.cId = sem_cam.cId";

        $lb = ($page-1)*$limit;
        $where = implode(' and ',$_where);
//        echo $where;

        //<option value="1">聚合：日期 - 项目</option>
        //<option value="2">聚合：日期 - 项目 - 账户</option>
        //<option value="3">聚合：日期 - 项目 - 人员</option>
        //<option value="4">聚合：日期 - 项目 - 计划</option>
        //<option value="5">聚合：日期 - 项目 - 账户 - 计划</option>
        //<option value="6">聚合：日期 - 项目 - 人员 - 计划</option>
        //<option value="7">聚合：日期 - 人员 - 项目 - 账户 - 计划</option>

        $list = [];
        $count = 0;
        $hidden = '';
        $field = "
sum(cost) as sumcost,
sum(rmb) as sumrmb,
sum(impression) as sumimpression ,
sum(click) as sumclick,
sum(zixun) as sumzixun,
sum(zhuanhua) as sumzhuanhua,
sum(liuyan) as sumliuyan,
sum(zhuanhua) as sumkf,
sum(zongshu) as sumzongshu";
        if($preporttemp){
            //根据数据模板，选择数据处理和隐藏字段
            switch($preporttemp){
                case 1:

                    //日期，项目
                    $sql = "select r_campaigndt.dt,sem_cam.xmId,$field
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId
order by r_campaigndt.dt desc,sem_cam.xmId
limit $lb,$limit
";
                    $sqlcount = "
select r_campaigndt.dt,sem_cam.xmId,cost
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId";
//echo $sql;
                    $list =  Db::query($sql);
                    //计算条数
                    $listcount = Db::query($sqlcount);
                    $count = count($listcount);
                    unset($listcount);

                    $list = $this->dolist($list);


                    //隐藏无效字段
                    $hidden = ['ustitle','zxmId','cId','cName','zhtitle','fd','ctr'];

                    break;
                case 2:
                    //日期，项目。账户

                    $sql = "select r_campaigndt.dt,sem_cam.xmId,sem_cam.zId,
$field
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,zId
order by r_campaigndt.dt desc,sem_cam.xmId
limit $lb,$limit
";
                    $sqlcount = "
select r_campaigndt.dt,sem_cam.xmId,zId,cost
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,zId";

                    $list =  Db::query($sql);
                    //计算条数
                    $listcount = Db::query($sqlcount);
                    $count = count($listcount);
                    unset($listcount);

                    $list = $this->dolist($list);


                    //隐藏无效字段
                    $hidden = ['ustitle','zxmId','cId','cName','fd','ctr'];

                    break;
                case 3:
//日期，项目。账户

                    //日期，项目
                    $sql = "select r_campaigndt.dt,sem_cam.xmId,sem_cam.uId,
$field
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,uId
order by r_campaigndt.dt desc,sem_cam.xmId
limit $lb,$limit
";
                    $sqlcount = "
select r_campaigndt.dt,sem_cam.xmId,uId,cost
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,uId";

                    $list =  Db::query($sql);
                    //计算条数
                    $listcount = Db::query($sqlcount);
                    $count = count($listcount);
                    unset($listcount);

                    $list = $this->dolist($list);

                    //隐藏无效字段
                    $hidden = ['zhtitle','zxmId','cId','cName','fd','ctr'];

                    break;
                case 4:
//日期，项目。账户

                    //日期，项目
                    $sql = "select r_campaigndt.dt,sem_cam.xmId,sem_cam.cId,r_campaigndt.fd,
$field
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,cId,fd
order by r_campaigndt.dt desc,sem_cam.xmId
limit $lb,$limit
";
                    $sqlcount = "
select r_campaigndt.dt,sem_cam.xmId,sem_cam.cId,r_campaigndt.fd,cost
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,cId,fd";

                    $list =  Db::query($sql);

                    //计算条数
                    $listcount = Db::query($sqlcount);


                    $count = count($listcount);
                    unset($listcount);
                    $list = $this->dolist($list);

                    //隐藏无效字段
                    $hidden = ['zhtitle','zxmId','ustitle','ctr'];

                    break;
                case 5:
//日期，项目，账户，计划

                    $sql = "select r_campaigndt.dt,sem_cam.xmId,sem_cam.zId, sem_cam.cId,r_campaigndt.fd,
$field
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,zId,cId,fd
order by r_campaigndt.dt desc,sem_cam.xmId
limit $lb,$limit
";
                    $sqlcount = "
select r_campaigndt.dt,sem_cam.xmId,sem_cam.zId,sem_cam.cId,r_campaigndt.fd,cost
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,zId,cId,fd";

                    $list =  Db::query($sql);

                    //计算条数
                    $listcount = Db::query($sqlcount);


                    $count = count($listcount);
                    unset($listcount);
                    $list = $this->dolist($list);

                    //隐藏无效字段
                    $hidden = ['zxmId','ustitle','ctr'];

                    break;
                case 6:
//日期，项目，人员，计划

                    $sql = "select r_campaigndt.dt,sem_cam.xmId,sem_cam.uId, sem_cam.cId,r_campaigndt.fd,
$field
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,uId,cId,fd
order by r_campaigndt.dt desc,sem_cam.xmId
limit $lb,$limit
";
                    $sqlcount = "
select r_campaigndt.dt,sem_cam.xmId,sem_cam.uId,sem_cam.cId,r_campaigndt.fd,cost
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,uId,cId,fd";

                    $list =  Db::query($sql);

                    //计算条数
                    $listcount = Db::query($sqlcount);


                    $count = count($listcount);
                    unset($listcount);
                    $list = $this->dolist($list);

                    //隐藏无效字段
                    $hidden = ['zxmId','zhtitle','ctr'];
                    break;
                case 7:
                    $sql = "select r_campaigndt.dt,sem_cam.xmId,sem_cam.uId, sem_cam.cId,sem_cam.zId,r_campaigndt.fd,
$field
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,uId,cId,zId,fd
order by r_campaigndt.dt desc,sem_cam.xmId
limit $lb,$limit
";
                    $sqlcount = "
select r_campaigndt.dt,sem_cam.xmId,sem_cam.uId,sem_cam.cId,sem_cam.zId,fd,cost
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,uId,cId,zId,fd";

                    $list =  Db::query($sql);

                    //计算条数
                    $listcount = Db::query($sqlcount);


                    $count = count($listcount);
                    unset($listcount);
                    $list = $this->dolist($list);

                    //隐藏无效字段
                    $hidden = ['zxmId','ctr'];
                    break;
                default:

            }

        }


        return [
            'code'=>0,
            'hidden'=>$hidden,             //隐藏某列
            'count'=>$count,
            'msg'=>'成功',
            'data'=>$list
        ];
    }

    public function dlist(request $request)
    {
        // $get = $request->get();
        //=============================================
        $page = $request->get('page');
        $limit = $request->get('limit');
        $xmflit = $request->get('xmflit');
        $zhflit = $request->get('zhflit');
        $usflit = $request->get('usflit');
        $meflit = $request->get('meflit');
        $dts = $request->get('dts');
        $preporttemp = $request->get('reporttemp');
        //=============================================
        if($xmflit){
            $_where[] = "sem_cam.xmId in($xmflit)";
        }
        if($zhflit){
            $zar = explode(',',$zhflit);
            $zmap = md('semzh')->getMap('id','uname');

            //=======in 查询==============================
            $_w = [];
            foreach($zar as $k=>$v){
                $_w[] = "'$zmap[$v]'";
            }
            $_wrstr = implode(',',$_w);
            $_where[] = "sem_cam.zId in($_wrstr)";
            //===========================================

        }
        if($usflit){
            $uar = explode(',',$usflit);
            //uid 映射
            $umap = md('user')->getMap('uId','name');

            //=======in 查询==============================
            $_w = [];
            foreach($uar as $k=>$v){
                $_w[] = "'$umap[$v]'";
            }
            $_wrstr = implode(',',$_w);
            $_where[] = "sem_cam.uId in($_wrstr)";
            //===========================================

       }

        if($meflit){
            $mediachr = getconfig('MEDIA_TYPE_CHR');
            $mediachr_ =  array_flip($mediachr);

            $mediachrarr = explode(',',$meflit);

            //=======in 查询==============================
            $_w = [];
            foreach($mediachrarr as $k=>$v){
                $_w[] = "'$mediachr_[$v]'";
            }
            $_wrstr = implode(',',$_w);
            $_where[] = "sem_cam.mediatype in($_wrstr)";
            //===========================================

//            //=======or 查询===== in 和都可以用================
//            foreach($mediachrarr as $k=>$v){
//                $_w[] = "sem_cam.mediatype = {$mediachr_[$v]}";
//            }
//            $_wrstr = implode(' or ',$_w);
//            $_where[] = "($_wrstr)";
//            //================================================

        }
        if($dts){
            $dtsar = explode('~',$dts);
            $dtsar[0] = trim($dtsar[0]);
            $dtsar[1] = trim($dtsar[1]);
            $_where[] = "r_campaigndt.dt between '{$dtsar[0]}' and '{$dtsar[1]}'";
        }

        $_where[] = "r_campaigndt.cId = sem_cam.cId";

        $lb = ($page-1)*$limit;
        $where = implode(' and ',$_where);
//        echo $where;

        //<option value="1">聚合：日期 - 项目</option>
        //<option value="2">聚合：日期 - 项目 - 账户</option>
        //<option value="3">聚合：日期 - 项目 - 人员</option>
        //<option value="4">聚合：日期 - 项目 - 计划</option>
        //<option value="5">聚合：日期 - 项目 - 账户 - 计划</option>
        //<option value="6">聚合：日期 - 项目 - 人员 - 计划</option>
        //<option value="7">聚合：日期 - 人员 - 项目 - 账户 - 计划</option>

        $list = [];
        $count = 0;
        $hidden = '';
        $field = "
sum(cost) as sumcost,sum(rmb) as sumrmb,
sum(impression) as sumimpression ,sum(click) as sumclick,
sum(zixun) as sumzixun,sum(zhuanhua) as sumzhuanhua,
sum(liuyan) as sumliuyan,sum(zhuanhua) as sumkf,
sum(zongshu) as sumzongshu";
        if($preporttemp){
            //根据数据模板，选择数据处理和隐藏字段
            switch($preporttemp){
                case 1:

                    //日期，项目
                    $sql = "select r_campaigndt.dt,sem_cam.xmId,$field
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId
order by r_campaigndt.dt desc,sem_cam.xmId
limit $lb,$limit
";
                    $sqlcount = "
select r_campaigndt.dt,sem_cam.xmId,cost
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId";
//echo $sql;
                    $list =  Db::query($sql);
                    //计算条数
                    $listcount = Db::query($sqlcount);
                    $count = count($listcount);
                    unset($listcount);

                    $list = $this->dolist($list);


                    //隐藏无效字段
                    $hidden = ['ustitle','zxmId','cId','cName','zhtitle','fd','ctr'];

                    break;
                case 2:
                    //日期，项目。账户

                    $sql = "select r_campaigndt.dt,sem_cam.xmId,sem_cam.zId,
$field
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,zId
order by r_campaigndt.dt desc,sem_cam.xmId
limit $lb,$limit
";
                    $sqlcount = "
select r_campaigndt.dt,sem_cam.xmId,zId,cost
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,zId";

                    $list =  Db::query($sql);
                    //计算条数
                    $listcount = Db::query($sqlcount);
                    $count = count($listcount);
                    unset($listcount);

                    $list = $this->dolist($list);


                    //隐藏无效字段
                    $hidden = ['ustitle','zxmId','cId','cName','fd','ctr'];

                    break;
                case 3:
//日期，项目。账户

                    //日期，项目
                    $sql = "select r_campaigndt.dt,sem_cam.xmId,sem_cam.uId,
$field
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,uId
order by r_campaigndt.dt desc,sem_cam.xmId
limit $lb,$limit
";
                    $sqlcount = "
select r_campaigndt.dt,sem_cam.xmId,uId,cost
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,uId";

                    $list =  Db::query($sql);
                    //计算条数
                    $listcount = Db::query($sqlcount);
                    $count = count($listcount);
                    unset($listcount);

                    $list = $this->dolist($list);

                    //隐藏无效字段
                    $hidden = ['zhtitle','zxmId','cId','cName','fd','ctr'];

                    break;
                case 4:
//日期，项目。账户

                    //日期，项目
                    $sql = "select r_campaigndt.dt,sem_cam.xmId,sem_cam.cId,r_campaigndt.fd,
$field
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,cId,fd
order by r_campaigndt.dt desc,sem_cam.xmId
limit $lb,$limit
";
                    $sqlcount = "
select r_campaigndt.dt,sem_cam.xmId,sem_cam.cId,r_campaigndt.fd,cost
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,cId,fd";

                    $list =  Db::query($sql);

                    //计算条数
                    $listcount = Db::query($sqlcount);


                    $count = count($listcount);
                    unset($listcount);
                    $list = $this->dolist($list);

                    //隐藏无效字段
                    $hidden = ['zhtitle','zxmId','ustitle','ctr'];

                    break;
                case 5:
//日期，项目，账户，计划

                    $sql = "select r_campaigndt.dt,sem_cam.xmId,sem_cam.zId, sem_cam.cId,r_campaigndt.fd,
$field
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,zId,cId,fd
order by r_campaigndt.dt desc,sem_cam.xmId
limit $lb,$limit
";
                    $sqlcount = "
select r_campaigndt.dt,sem_cam.xmId,sem_cam.zId,sem_cam.cId,r_campaigndt.fd,cost
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,zId,cId,fd";

                    $list =  Db::query($sql);

                    //计算条数
                    $listcount = Db::query($sqlcount);


                    $count = count($listcount);
                    unset($listcount);
                    $list = $this->dolist($list);

                    //隐藏无效字段
                    $hidden = ['zxmId','ustitle','ctr'];

                    break;
                case 6:
//日期，项目，人员，计划

                    $sql = "select r_campaigndt.dt,sem_cam.xmId,sem_cam.uId, sem_cam.cId,r_campaigndt.fd,
$field
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,uId,cId,fd
order by r_campaigndt.dt desc,sem_cam.xmId
limit $lb,$limit
";
                    $sqlcount = "
select r_campaigndt.dt,sem_cam.xmId,sem_cam.uId,sem_cam.cId,r_campaigndt.fd,cost
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,uId,cId,fd";

                    $list =  Db::query($sql);

                    //计算条数
                    $listcount = Db::query($sqlcount);


                    $count = count($listcount);
                    unset($listcount);
                    $list = $this->dolist($list);

                    //隐藏无效字段
                    $hidden = ['zxmId','zhtitle','ctr'];
                    break;
                case 7:
                    $sql = "select r_campaigndt.dt,sem_cam.xmId,sem_cam.uId, sem_cam.cId,sem_cam.zId,r_campaigndt.fd,
$field
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,uId,cId,zId,fd
order by r_campaigndt.dt desc,sem_cam.xmId
limit $lb,$limit
";
                    $sqlcount = "
select r_campaigndt.dt,sem_cam.xmId,sem_cam.uId,sem_cam.cId,sem_cam.zId,fd,cost
from r_campaigndt,sem_cam
where $where and r_campaigndt.cId = sem_cam.cId
group by dt,xmId,uId,cId,zId,fd";

                    $list =  Db::query($sql);

                    //计算条数
                    $listcount = Db::query($sqlcount);


                    $count = count($listcount);
                    unset($listcount);
                    $list = $this->dolist($list);

                    //隐藏无效字段
                    $hidden = ['zxmId','ctr'];
                    break;
                default:

            }

        }


        return [
            'code'=>0,
            'hidden'=>$hidden,             //隐藏某列
            'count'=>$count,
            'msg'=>'成功',
            'data'=>$list
       ];
    }


    public function dolist($list)
    {
        $mxmap = md('semxm')->getMap('title','xmId');
        $umap = md('user')->getMap('trueName','uId');
        $zhmap = md('semzh')->getMap('uname','id');
        $cammap = md('semcam')->getMap('cName','cId');

        //计算 点击价格，转化率，性价比
        foreach($list as $key=>$value){
            //点击价格
            if(empty($value['sumclick'])){
                $list[$key]['cpc'] = 0;
            }else{
                $list[$key]['cpc'] = round($value['sumcost']/$value['sumclick'],2);
            }
            //转化率
            if(empty($value['sumzixun'])) {
                $list[$key]['zhuanhualv'] = 0;
            }else{
                $list[$key]['zhuanhualv'] = round($value['sumzhuanhua']/$value['sumzixun'],2);
            }
            //性价比
            if(empty($value['sumzongshu'])) {
                $list[$key]['xingjiabi'] = 0;
            }else{
                $list[$key]['xingjiabi'] = round($value['sumrmb']/$value['sumzongshu'],2);
            }

            //翻译项目名
            $list[$key]['xmtitle'] = isset($mxmap[$value['xmId']])?$mxmap[$value['xmId']]:'-';;

            //用户
            if(isset($value['uId'])){
                $list[$key]['ustitle'] = isset($umap[$value['uId']])?$umap[$value['uId']]:'-';
            }

            //账号
            if(isset($value['zId'])){
            $list[$key]['zhtitle'] = isset($zhmap[$value['zId']])?$zhmap[$value['zId']]:'-';
            }

            //计划
            if(isset($value['cId'])){
                $list[$key]['cName'] = isset($cammap[$value['cId']])?$cammap[$value['cId']]:'-';
            }

        }

        return $list;
    }


}
