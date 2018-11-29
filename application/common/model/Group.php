<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;

//use traits\model\SoftDelete;

class Group extends BaseModel
{

    protected $pk = 'groupId';
    protected $table = 'sys_group';
    //=============================================

// 设置当前模型的数据库连接
//    protected $connection = [
//    ];

}
