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
        elem: '#LAY-content-list'
        ,url: '/api/demo/dlist' //模拟接口
        ,cols: [[
            {field: 'uId', width: 80, title: 'xmId', sort: true}
            ,{field: 'name', title: '名称'}
            ,{field: 'enable', title: '是否有效', templet: '#buttonTpl', minWidth: 80, align: 'center'}
            ,{title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#table-admin-manage'}
        ]]
        ,page: true
        ,limit: 10
        //,height: 'full-220'
        ,text: '对不起，加载出现异常！'
    });

    //监听工具条
    table.on('tool(LAY-content-list)', function(obj){
        var data = obj.data;
        if(obj.event === 'del'){
            layer.confirm('确定删除此角色？', function(index){

                //=====================================

                $.ajax({
                    url: '/api/demo/delete'
                    ,type:'GET'
                    ,data: 'id='+data.uId
                    ,success: function(res){
                        if(res.code==0){
                            layer.msg('删除成功');
                            obj.del();
                            layer.close(index);
                        }
                    }
                });

            });
        }else if(obj.event === 'edit'){
            var tr = $(obj.tr);
            var data = obj.data;

            layer.open({
                type: 2
                ,title: '编辑角色'
                ,content: '/d/demoedit.html?id='+data.uId
                ,area: ['500px', '450px']
                ,btn: ['确定', '取消']
                ,yes: function(index, layero){


                    var iframeWindow = window['layui-layer-iframe'+ index]
                        ,submitID = 'LAY-edit-front-submit'
                        ,submit = layero.find('iframe').contents().find('#'+ submitID);

                    //监听提交
                    iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
                            var field = data.field; //获取提交的字段
                        $.ajax({
                            url: '/api/demo/edit'
                            ,type:'POST'
                            ,data: field
                            ,success: function(res){
                                if(res.code==0){
                                    layer.msg('编辑');
                                    table.reload('LAY-content-list'); //数据刷新
                                    layer.close(index); //关闭弹层
                                }
                            }
                        });

                    });
                    submit.trigger('click');

                    //另外一种处理办法
                    ////获取iframe元素的值
                    //var othis = layero.find('iframe').contents().find("#layuiadmin-form-replys");
                    //var content = othis.find('textarea[name="content"]').val();
                    ////数据更新
                    //obj.update({
                    //    content: content
                    //});
                    //layer.close(index);

                }
                ,success: function(layero, index){
                }
            })

        }
    });

    exports('demo', {})
});