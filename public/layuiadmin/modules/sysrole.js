/**

 @Name：layuiAdmin 用户管理 管理员管理 角色管理
 @Author：star1029
 @Site：http://www.layui.com/admin/
 @License：LPPL
    
 */


layui.define(['table', 'form'], function(exports){
  var $ = layui.$
  ,table = layui.table
  ,form = layui.form;


  //角色管理
  table.render({
    elem: '#LAY-user-back-role'
    ,url: '/sys/jsonlist/role' //模拟接口
    ,cols: [[
      {field: 'roleId', width: 80, title: 'ID', sort: true}
      ,{field: 'title', title: '角色名'}
      ,{field: 'funs', title: '拥有权限'}
      ,{field: 'dis', title: '具体描述'}
      ,{title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#table-useradmin-admin'}
    ]]
    ,text: '对不起，加载出现异常！'
  });
  
  //监听工具条
  table.on('tool(LAY-user-back-role)', function(obj){
    var data = obj.data;
    if(obj.event === 'del'){
      layer.confirm('确定删除此角色？', function(index){
        obj.del();
        layer.close(index);
      });
    }else if(obj.event === 'edit'){
      var tr = $(obj.tr);

      layer.open({
        type: 2
        ,title: '编辑角色'
        ,content: '../../../views/user/administrators/roleform.html'
        ,area: ['500px', '480px']
        ,btn: ['确定', '取消']
        ,yes: function(index, layero){
          var iframeWindow = window['layui-layer-iframe'+ index]
          ,submit = layero.find('iframe').contents().find("#LAY-user-role-submit");

          //监听提交
          iframeWindow.layui.form.on('submit(LAY-user-role-submit)', function(data){
            var field = data.field; //获取提交的字段




            //提交 Ajax 成功后，静态更新表格中的数据
            //$.ajax({});
            table.reload('LAY-user-back-role'); //数据刷新
            layer.close(index); //关闭弹层
          });  
          
          submit.trigger('click');
        }
        ,success: function(layero, index){
        
        }
      })
    }
  });

  exports('sysrole', {})
});