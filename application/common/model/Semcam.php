<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;

class Semcam extends Base
{

    //fdsal 无效
    protected $pk = 'cId';
    protected $table = 'sem_cam';

    /*
     * 子项目有所属的人员和信息流属性， 【计划中没有】
     * 计划有媒体和账户属性
     * hand = 1 标识手动计划
     *
     *
     * 更新的时候设置
     * 所属账号 需要设置
     * 子项目ID
     * 用户
     * 项目
     */

//      $user = md('semcam')->find(90269652);
//      $ug = $user->zxm;
//      $ug = $user->zh;
//      $ug = $user->user;
//      $ug = $user->xm;
//      print_r($ug);

    //一对多子项目
    public function zxm()
    {
        return $this->hasOne('Semzxm','zxmId','zxmId');
    }

    public function zh()
    {
        return $this->hasOne('Semzh','id','zId');
    }

    public function xm()
    {
        return $this->hasOne('Semxm','xmId','xmId');
    }

}

