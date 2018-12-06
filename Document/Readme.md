# Readme 【全系统】

---

标准代码
---
    

    
    
### 基础工具

    http://ue.so/sys/tools.message/index
    http://ue.so/sys/tools.message/index
    http://ue.so/sys/tools.message/index
    备份数据
    站点设置
    消息管理
    系统服务
    缓存管理
    模板文件管理
    日志管理
    
    /sys/setup
    /sys/dbbackup
    /sys/service        服务
    /sys/cache          缓存管理
    /sys/tempfile       模板文件
    /sys/message        消息
    /sys/log            日志
    
### 超级管理
    
   http://ue.so/super/menu/index
   
   http://ue.so/super/ads/index
   
   
   
### 字典管理
   
//   http://ue.so/sys/dic.group/index
   
   
### sys/my
   
   http://ue.so/sys/my.info/index
   
   http://ue.so/sys/my.password/index

### sys/user   
   
   http://ue.so/sys/user.user/index
    
   http://ue.so/sys/user.group/index
   
### 登陆
   
   http://ue.so/login
   
```
总结
ac('auth')->IsLogin();
ac('auth')->clear();

ac('my')->isLogin();
getInfo
getUserId

角色管理

location.reload();


<!--<script type="text/html" id="buttonTpl">-->
    <!--<a href="/news" class="layui-btn layui-btn-xs">预览</a>-->
<!--</script>-->
<script type="text/html" id="table-group-admin">
    <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
</script>
    <!--<script type="text/html" id="imgTpl">-->
               <!--<img style="display: inline-block; width: 50%; height: 100%;" src= {{ d.avatar }}>-->
               <!--</script>-->
               <script type="text/html" id="usexTpl">
               <img style="display: inline-block; width: 50%; height: 100%;" src= {{ d.sex }}>
               </script>
<script type="text/html" id="buttonTpl">
  {{#  if(d.check == true){ }}
    <button class="layui-btn layui-btn-xs">已审核</button>
  {{#  } else { }}
    <button class="layui-btn layui-btn-primary layui-btn-xs">未审核</button>
  {{#  } }}
</script>         
```