<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;

//use traits\model\SoftDelete;

class Paymentuserdc extends \think\Model
{

    protected $table = 'r_paymentuserdc';
    protected $pk = 'puId';

//    protected $deleteTime = 'deleteTime';       //删除时间
//    // 关闭自动写入update_time字段
//    protected $updateTime = false;
//    // 关闭自动写入时间戳
//    protected $autoWriteTimestamp = false;

}

