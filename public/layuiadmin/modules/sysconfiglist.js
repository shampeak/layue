/**

 @Name：layuiAdmin 内容系统
 @Author：star1029
 @Site：http://www.layui.com/admin/
 @License：LPPL
    
 */


layui.define(['table', 'form','admin'], function(exports){
  var $ = layui.$
  ,table = layui.table
  ,form = layui.form;

  //文章管理
  table.render({
    elem: '#LAY-app-content-list'
    ,url: '/api/sys.config/dlist' //模拟接口
    ,cols: [[
      {field: 'name', title: '标识', sort: true}
      ,{field: 'title', title: '文章标题'}
      ,{field: 'type',width: 50, title: '类型'}
      ,{field: 'extra', title: '选项'}
      ,{field: 'value', title: '值'}

      ,{field: 'status', width: 70, title: '状态', templet: '#buttonTpl',minWidth: 60, align: 'center'}
      ,{title: '操作', minWidth: 150, align: 'center', fixed: 'right', toolbar: '#table-content-list'}
    ]]
    ,page: true
    ,limit: 10
    ,limits: [10, 15, 20, 25, 30]
    ,text: '对不起，加载出现异常！'
  });
  
  //监听工具条
  table.on('tool(LAY-app-content-list)', function(obj){
    var data = obj.data;
    if(obj.event === 'del'){
      layer.confirm('确定删除此文章？', function(index){

          $.ajax({
              type: "GET",
              url: "/api/sys.config/delete?id="+data.id,
//              data: {username:$("#username").val(), content:$("#content").val()},
              dataType: "json",
              success: function(res){
                  if(res.code==0){
                      table.reload('LAY-sys-user-group');
                      layer.close(index);
                  }
              }
          });


        obj.del();
        layer.close(index);
      });
    } else if(obj.event === 'edit'){
      layer.open({
        type: 2
        ,title: '编辑文章'
        ,content: '/sys/platform.config/edit?id='+ data.id
        ,maxmin: true
        ,area: ['550px', '550px']
        ,btn: ['确定', '取消']
        ,yes: function(index, layero){
          var iframeWindow = window['layui-layer-iframe'+ index]
          ,submit = layero.find('iframe').contents().find("#layuiadmin-app-form-edit");

          //    //监听提交
          //iframeWindow.layui.form.on('submit(layuiadmin-app-form-edit)', function(data){
          //  var field = data.field; //获取提交的字段
          //  //提交 Ajax 成功后，静态更新表格中的数据
          //
          //    alert(111);
          //  //$.ajax({});
          //  obj.update({
          //    label: field.label
          //    ,title: field.title
          //    ,author: field.author
          //    ,status: field.status
          //  }); //数据更新
          //  form.render();
          //  layer.close(index); //关闭弹层
          //
          //});
          
          submit.trigger('click');
        }
      });
    }
  });



  exports('sysconfiglist', {})
});