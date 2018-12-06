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


  //角色管理
  table.render({
    elem: '#LAY-content-category'
    ,url: '/content/json/categorylist' //模拟接口
    ,cols: [[
      {field: 'cId', width: 80, title: 'ID', sort: true}
      ,{field: 'title', title: '分类名称'}
      ,{field: 'chr', title: '标识字符'}
      ,{field: 'hidden', title: '隐藏'}
      ,{title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#table-content-category'}
    ]]
    ,text: '对不起，加载出现异常！'
  });
  
  //监听工具条
  table.on('tool(LAY-content-category)', function(obj){
    var data = obj.data;
    if(obj.event === 'del'){
      layer.confirm('确定删除此角色？', function(index){

          //=====================================
          //删除
          var data = obj.data;
          admin.req({
              url: '/content/json/categorydelete'
              ,type:'POST'
              ,data: 'id='+data.cId
              ,success: function(res){
              }
          });
          obj.del();
          layer.close(index);

      });
    }else if(obj.event === 'edit'){
      var tr = $(obj.tr);
        var data = obj.data;

      layer.open({
        type: 2
        ,title: '编辑角色'
        ,content: '/content/category/edit?id='+data.cId
        ,area: ['500px', '350px']
        ,btn: ['确定', '取消']
        ,yes: function(index, layero){


//获取iframe元素的值
              //============================================
              var formar = layero.find('iframe').contents().find("#layuiadmin-form-edit");
              //============================================
              admin.req({
                  url: '/content/json/categoryedit'
                  ,type:'post'
                  ,data: formar.serialize()
                  ,done: function(res){
                      //提交 Ajax 成功后，静态更新表格中的数据
                      //$.ajax({});
                      table.reload('LAY-content-category'); //数据刷新
                      layer.close(index); //关闭弹层
                      //layer.close(index);
                      //location.reload();
                  }
              });


        }
        ,success: function(layero, index){
        
        }
      })
    }
  });

  exports('contentcategory', {})
});