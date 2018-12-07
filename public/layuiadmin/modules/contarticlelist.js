/**

 @Name：layuiAdmin 内容系统
 @Author：star1029
 @Site：http://www.layui.com/admin/
 @License：LPPL
    
 */


layui.define(['table', 'form', 'upload'], function(exports){
  var $ = layui.$
  ,table = layui.table
  ,form = layui.form
      ,upload = layui.upload;






  //文章管理
  table.render({
    elem: '#LAY-app-content-list'
    ,url: '/content/json/articlelist' //模拟接口
    ,cols: [[
      //{type: 'checkbox', fixed: 'left'}
      //,
      {field: 'id', width: 100, title: '文章ID', sort: true}
      ,{field: 'label', title: '文章标签', minWidth: 100}
      ,{field: 'title', title: '文章标题'}
      ,{field: 'author', title: '作者'}
      ,{field: 'createAt', title: '上传时间', sort: true}
      ,{field: 'status', title: '发布状态', templet: '#buttonTpl', minWidth: 80, align: 'center'}
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

          alert(3);

        obj.del();
        layer.close(index);
      });
    } else if(obj.event === 'edit'){
      var windowsfull = layer.open({
        type: 2
        ,title: '编辑文章'
        ,content: '/content/article/edit?id='+ data.id
        ,maxmin: true
        ,area: ['550px', '550px']
        ,btn: ['确定', '取消']
        ,yes: function(index, layero){
          var iframeWindow = window['layui-layer-iframe'+ index]
          ,submit = layero.find('iframe').contents().find("#layuiadmin-app-form-edit");

          //监听提交
          iframeWindow.layui.form.on('submit(layuiadmin-app-form-edit)', function(data){
            var field = data.field; //获取提交的字段
            
            //提交 Ajax 成功后，静态更新表格中的数据
            //$.ajax({});
              alert(2);




            obj.update({
              label: field.label
              ,title: field.title
              ,author: field.author
              ,status: field.status
            }); //数据更新
            
            form.render();
            layer.close(index); //关闭弹层
          });  
          
          submit.trigger('click');
        }
      });
        layer.full(windowsfull);
    }
  });



  exports('contarticlelist', {})
});