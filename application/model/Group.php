<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\model;

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

/*
 *
count	统计数量，参数是要统计的字段名（可选）
max	获取最大值，参数是要统计的字段名（必须）
min	获取最小值，参数是要统计的字段名（必须）
avg	获取平均值，参数是要统计的字段名（必须）
sum	获取总分，参数是要统计的字段名（必须） *
 *
 *
 *
    [All] => 1800
    [List] => 20
    [Index] => 20

    [Map] => 1800
    [Col] => 20

    [Row] => 20
    [One] => 20

 *
 *
 * 一 查询所有数据
 * All
 * List
 * Index
 *
 * 二 ： 行数据
 * row
 * One
 *
 * 三 ： 列数据
 * Col
 * Map
 *
 * //============================================
 * 数据库标准配置
 *
 *
//====================================
 * get() 用法 (主键值或者查询条件（闭包）)
//====================================
        $row = md('Group')->get(6);
        $list = md('Group')->all([3,99]);
        $list = md('Group')->all(99);
        $row = Group::get(3);
        $row = Group::all(3,99);
        $list = Group::where('enable',1)->get(3);
        $list = Group::where('enable',1)->all(3,99);


//====================================
 * find() 用法 (主键值或者查询条件（闭包）)
//====================================
        $row = md('Group')->find(6);
        $row = $row->toArray();


//====================================
 * 单条数据查询
//====================================
        $row = md('Group')->find(99);
        $row = md('Group')->get(99);
        $row = Group::get(99);
        $row = Group::find(99);
        $row = md('Group')->where('enable',1)->find(99);
//        $row = md('Group')->where('enable',1)->get(99);             //wrong
        $row = Group::where('enable',1)->find(99);
        $row = $row->toArray();




//====================================
 * getLastInsID() 用法
//====================================



 */