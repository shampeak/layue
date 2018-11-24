<?php
namespace app\model;

use traits\model\SoftDelete;

/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/26
 * Time: 15:39
 */
class Base extends \think\Model
{

//    use SoftDelete;
//    protected $deleteTime = 'deleteTime';       //删除时间
//    protected $autoWriteTimestamp = true;       //打开自动写入时间戳
//    protected $createTime = 'createAt';
//    protected $updateTime = 'updateAt';

    public function __construct($data = [])
    {
        parent::__construct($data);
    }

}