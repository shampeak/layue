# Js 【前端】

---



    //提交修改
    admin.req({
        url: '/wsite/set/indexPost'
        ,type: 'POST'
        ,data: obj.field
        ,success: function(res){
            layer.msg(res.msg);
        }
    });



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
           <link rel="stylesheet" href="/static/Sham.css" media="all">
           <script src="/static/Sham.js"></script>
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
    
