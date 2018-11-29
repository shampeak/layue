<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;

class Role extends Base
{

    protected $pk = 'roleId';
    protected $table = 'sys_role';
//    protected $autoWriteTimestamp = true;       //打开自动写入时间戳
//    protected $createTime = 'createAt';
//    protected $updateTime = 'updateAt';

}

