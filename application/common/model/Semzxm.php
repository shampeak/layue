<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;

class Semzxm extends Base
{

    //fdsal 无效
    protected $pk = 'zxmId';
    protected $table = 'sem_zxm';


    /*
     * 子项目有所属的人员和信息流属性， 【计划中没有】
     */

    //一对多子项目
    public function cam()
    {
        return $this->hasMany('Semcam','zxmId');
    }

    //一对多子项目
    public function xm()
    {
        return $this->hasOne('Semxm','xmId','xmId');
    }

    public function user()
    {
        return $this->hasOne('user','uId','uId');
    }


}

