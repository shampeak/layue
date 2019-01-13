<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;

class Semzh extends Base
{

    //rebate 无效
    protected $pk = 'id';
    protected $table = 'sem_zh';

    public function zxm()
    {
        return $this->hasOne('Semzxm','zxmId','zxmId');
    }


}

