<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;

class Usergroup extends Base
{

    protected $pk = 'uId';
    protected $table = 'sys_usergroup';

//$usergroup = md('usergroup')->find(136);
//$ug = $usergroup->user;
//$ug = $usergroup->group;
//$ug = $usergroup->groupads;
//print_r($ug);

//用户查询
//$ug = md('usergroup')->hasWhere('user',['name'=>'135'])->find();


//查询用户

    public function user()
    {
        return $this->hasOne('User', 'uId');
    }

    public function getGroupAttr()
    {
        $groupid =  $this->groupId;
        return md('group')->find($groupid);
    }

    public function getGroupAdsAttr()
    {
        $group = $this->group;
        return $group->groupads;
    }








}

