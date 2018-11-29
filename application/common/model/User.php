<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;

class User extends BaseModel
{

    protected $pk = 'uId';
    protected $table = 'sys_user';
    protected $readonly = ['name'];     //只读字段


}

