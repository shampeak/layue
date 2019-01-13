/**

 @Name：layuiAdmin 用户管理 管理员管理 角色管理
 @Author：star1029
 @Site：http://www.layui.com/admin/
 @License：LPPL
    
 */


layui.define(['table', 'form'], function(exports){
  var $ = layui.$
  ,table = layui.table
      ,admin = layui.admin
  ,form = layui.form;


  //用户管理
  table.render({
    elem: '#LAY-user-manage'
    ,url: '/sys/user.json/userlist' //模拟接口
      /*toolbar: '#toolbarDemo' //指向自定义工具栏模板选择器
       toolbar: '<div>xxx</div>' //直接传入工具栏模板字符
       toolbar: true //仅开启工具栏，不显示左侧模板
       toolbar: 'default' //让工具栏左侧显示默认的内置模板         */
    //,toolbar: '#toolbarDemo'
    ,title: '用户数据表'
      ,totalRow: true           //开启count
      ,cols: [[
      //{type: 'checkbox', fixed: 'left'}
      {field: 'uId', width: 100, title: 'ID', sort: true,fixed: 'left'}
          ,{field: 'name', title: '用户名', minWidth: 100,  totalRow: true, edit:'text',}
          ,{field: 'name', title: '用户名1', minWidth: 100,  totalRow: true }
          ,{field: 'name', title: '用户名2', minWidth: 100,  totalRow: true }
      ,{field: 'groupName', title: '用户组', width: 100}

          ,{field: 'mobile', title: '手机',edit:'text',fixed: 'right'}

,{field: 'mobile4', title: '手机999',edit:'text',fixed: 'right', style:'background-color: #5FB878; color: #fff;' }
,{field:'uId',      title: '操作2', edit:'text',style:'background-color: #5FB878; color: #fff;',templet: function(d){
//              return d.uId;
//              return '<div class="bg-blue">'+ d.uId +'</div>';
              return '<div class="text-blue">'+ d.uId +'</div>';
          }}

      ,{field: 'email', title: '邮箱'}
      ,{field: 'sex', width: 80, title: '性别', templet: '#usexTpl'}
      ,{field: 'ip', title: 'IP'}
      ,{field: 'jointime', fixed: 'right',title: '加入时间', sort: true}
//      ,{title: '操作',fixed: 'left', width: 150, align:'center', fixed: 'right', toolbar: '#table-useradmin-webuser'}
    ]]
    //,page: true
    ,limit: 200
    //,height: 'full-40'
    ,text: '对不起，加载出现异常！',
    done: function (res, curr, count) {
    }
  });

    table.on('edit(LAY-user-manage)', function(obj){ //注：edit是固定事件名，test是table原始容器的属性 lay-filter="对应的值"

        layer.msg('修改');
        console.log(obj.value); //得到修改后的值
        console.log(obj.field); //当前编辑的字段名
        console.log(obj.data); //所在行的所有相关数据
    });


  exports('semmytask', {})
});