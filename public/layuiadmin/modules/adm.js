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


    $('.adshowbox').click(function(obj){


        var windowsfull = layer.open({
            type: 2
            ,title: '编辑角色'
            ,content: '/ad/man/edit?id='+$(this).attr('relid')
            ,area: ['800px', '600px']
            ,btn: ['确定', '取消']
            ,yes: function(index, layero){


//获取iframe元素的值
                //============================================
                var formar = layero.find('iframe').contents().find("#layuiadmin-form-edit");
                //============================================
                admin.req({
                    url: '/ad/json/mainadedit'
                    ,type:'post'
                    ,data: formar.serialize()
                    ,done: function(res){
                        //提交 Ajax 成功后，静态更新表格中的数据
                        //layer.close(index); //关闭弹层
                        layer.close(index); //关闭弹层
                        location.reload();
                    }
                });

            }
            ,success: function(layero, index){

            }
        })

        layer.full(windowsfull);



    });



  exports('adm', {})
});