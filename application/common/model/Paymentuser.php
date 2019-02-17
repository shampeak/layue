<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;


class Paymentuser extends \think\Model
{

    protected $table = 'f_paymentuser';
    protected $pk = 'puId';

//    protected $autoWriteTimestamp = true;
//    protected $deleteTime = 'deleteTime';       //删除时间
//    // 关闭自动写入update_time字段
//    protected $updateTime = 'updateAt';
//    protected $createTime = 'createAt';
//    // 关闭自动写入时间戳
//
//    use SoftDelete;

}

