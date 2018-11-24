# Readme 【全系统】

---

标准代码
---
    
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Sadm std - 后台管理</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="stylesheet" href="../layuiadmin/layui/css/layui.css" media="all">
        <link rel="stylesheet" href="../layuiadmin/style/admin.css" media="all">
    </head>
    <body>
    <!-- -->
    
    
    <!-- -->
    <script src="../layuiadmin/layui/layui.js"></script>
    <script>
        layui.config({
            version: new Date().getTime(),
            base: '../layuiadmin/'
        }).extend({
            index: 'lib/index'
        }).use('index');
    </script>
    </body>
    </html>
    





## 有效模块


规划
---


## 边界

1.模块控制器边界
2.模块规划边界
3.页面功能边界



形式 ： 
    
    - 一个入口地址就有精彩内容

形式 ： 
- 会更改相关的页面和数据 在相应时间 和 页面 或者
- 用widget形式对缘由功能和页面进行修改
- 在菜单上对缘由功能进行修改或补充

补丁 ： 

    - 更改原来的数据，用文件形式进行覆盖
    
数据 ： 

    - 根据现有的功能获取相对应的数据

事件 ： 
    
    - 根据参数和时间名执行相关操作

中间件 ：

    - 执行 
    - 过滤
    
功能模块
        
    - 一系列功能组成模块
    - 模块之间有边界
    - 功能之间也有边界
    - 一个模块内，功能组成权限和菜单


---
