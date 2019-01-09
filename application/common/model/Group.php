<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;

//use traits\model\SoftDelete;

class Group extends Base
{

    protected $pk = 'groupId';
    protected $table = 'sys_group';
    //=============================================

// 设置当前模型的数据库连接
//    protected $connection = [
//    ];

    /*
     * 一对一 groupads
     */
    public function Groupads()
    {
        return $this->hasOne('groupads', 'groupId');
    }


    /*
        $group = md('group')->find(999);
        $ms = $group->Ulist;
        $ms = $group->Groupads;
        print_r($ms);
        exit;
     */
    public function Ulist()
    {
        return $this->hasMany('User','groupId');
    }


}
