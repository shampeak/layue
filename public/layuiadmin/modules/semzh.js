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
        ,url: '/api/sem.zh/dlist' //模拟接口
        ,cols: [[
            {field: 'id', width: 60, title: 'Id', sort: true}
            ,{field: 'uname', title: '名称'}
            ,{field: 'media', width:80, title: '媒体'}
            ,{field: 'type', width:60, title: '类型',templet: function(d){
                if(d.type == 0){
                    return '自用';
                }else{
                    return '放户';
                }
            }}
            ,{field: 'rate', width: 60, title: '返点'}
            ,{field: 'rebatexx', width: 80, title: '信息流' , templet: function(d){
                if(d.mediatype == 1 && d.rebatexx != null){
                    return '<div class="text-blue">'+ d.rebatexx +'</div>';
                }else{
                    return '';
                }
            }}
            ,{field: 'lastApitime', width: 120,  title: 'Api时间'}
            ,{field: 'connectcheck', width: 80,  title: '连接', templet: '#connectcheck', minWidth: 80, align: 'center'}
            ,{field: 'enable', width: 100,  title: '是否有效', templet: '#buttonTpl', minWidth: 80, align: 'center'}
            ,{title: '操作', width: 280, align: 'center', fixed: 'right', toolbar: '#table-admin-manage'}
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
            layer.confirm('确定删除此账号？', function(index){

                //=====================================

                $.ajax({
                    url: '/api/sem.zh/delete'
                    ,type:'GET'
                    ,data: 'id='+data.id
                    ,success: function(res){
                        if(res.code==0){
                            layer.msg('删除成功');
                            obj.del();
                            layer.close(index);
                        }
                    }
                });

            });
        }else if(obj.event === 'enable'){
            var data = obj.data;
//            console.log(obj.data.id);
            $.ajax({
                url: '/api/sem.zh/enable'
                ,type:'POST'
                ,data: data
                ,success: function(res){
                    if(res.code==0){
                        table.reload('LAY-content-list');
                    }else{
//                        layer.msg(res.msg);
                    }
                }
            });

        }else if(obj.event === 'edit'){
            var tr = $(obj.tr);
            var data = obj.data;

            layer.open({
                type: 2
                ,title: '编辑角色'
                ,content: '/sem/sys.zh/edit?id='+data.id
                ,area: ['550px', '450px']
                ,btn: ['确定', '取消']
                ,yes: function(index, layero){

                    var iframeWindow = window['layui-layer-iframe'+ index]
                        ,submitID = 'LAY-edit-front-submit'
                        ,submit = layero.find('iframe').contents().find('#'+ submitID);

                    //监听提交
                    iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
                        var field = data.field; //获取提交的字段
                        $.ajax({
                            url: '/api/sem.zh/edit'
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

        }else if(obj.event === 'fd'){

            layer.open({
                type: 2
                ,title: '返点'
                ,content: '/sem/sys.zh/fd?id='+data.id
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
                            url: '/api/sem.zh/editfd'
                            ,type:'POST'
                            ,data: field
                            ,success: function(res){
                                if(res.code==0){
                                    layer.msg('编辑');
                                    table.reload('LAY-content-list'); //数据刷新
                                    layer.close(index); //关闭弹层
                                }else{
                                    layer.msg(res.msg);
                                }
                            }
                        });

                    });
                    submit.trigger('click');
                }
                ,success: function(layero, index){
                }
            })

        }else if(obj.event === 'api'){

            layer.open({
                type: 2
                ,title: '编辑角色'
                ,content: '/sem/sys.zh/showapi?id='+data.id
                ,area: ['500px', '450px']
                ,btn: ['确定', '取消']
                ,yes: function(index, layero){
                }
                ,success: function(layero, index){
                }
            })
        }
    });

    exports('semzh', {})
});