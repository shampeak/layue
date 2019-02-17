<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;

class Semxm extends Base
{

    //fdsal 无效
    protected $pk = 'xmId';
    protected $table = 'sem_xm';

    //一对多子项目

    public function zxm()
    {
        return $this->hasMany('Semzxm','xmId');
    }



}

