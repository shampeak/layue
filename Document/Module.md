# Module 【模块】



模块
---
super
    - ads
    - menu
    js ： super
















```
规则

一个路由 例如
/super/ads                  列表界面
/super/ads/box_edit         编辑界面        box标记 是一个表单，不需要编辑单独的js
/super/ads/box_addnew       添加界面

/super/json/adsdelete      删除
/super/json/adslist        列表
/super/json/adsedit        编辑提交
/super/json/adsaddnew      添加提交

//==========================================================
ac 元数据和元计算 获取 dt('dt') 职能获取自身模块dt目录的内容
//==========================================================

js : 
superads.js

esb
ac
model
event

```




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