/**

 @Name：layuiAdmin 内容系统
 @Author：star1029
 @Site：http://www.layui.com/admin/
 @License：LPPL

 */


layui.define(['table', 'form'], function(exports){
    var $ = layui.$
        ,table = layui.table
        ,admin = layui.admin
        ,form = layui.form
        ,upload = layui.upload;




    //文章管理
    table.render({
        elem: '#LAY-app-content-list'
        //,url: layui.setter.base + 'json/content/list.js' //模拟接口
        ,url: '/wsite/json/arlist' //模拟接口
        ,cols: [[
            //{type: 'checkbox', fixed: 'left'}
            {field: 'id', width: 100, title: '文章ID', sort: true}
            ,{field: 'catName', title: '分类', minWidth: 100}
            ,{field: 'title', title: '文章标题'}
            ,{field: 'author', title: '作者'}
            ,{field: 'tm', title: '时间', sort: true}
            //,{field: 'id', title: '发布状态', templet: '#buttonTpl', minWidth: 80, align: 'center'}
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
                //删除
                //=====================================
                //shanchu
                //=====================================
                //提交修改
                var data = obj.data;
                admin.req({
                    url: '/wsite/json/ardelete'
                    ,type:'POST'
                    ,data: 'id='+data.id
                    ,success: function(res){
                    }
                });
                obj.del();
                layer.close(index);
            });
        } else if(obj.event === 'edit'){
            layer.open({
                type: 2
                ,title: '编辑文章'
                ,content: '/wsite/ar/edit?id='+ data.id
                ,maxmin: true
                ,area: ['800px', '450px']
                ,btn: ['确定', '取消']
                ,yes: function(index, layero){

                    //获取iframe元素的值
                    //============================================
                    var formar = layero.find('iframe').contents().find("#layuiadmin-app-form-content");
                    //============================================
                    admin.req({
                        url: '/wsite/json/aredit'
                        ,type:formar.attr("method")
                        ,data: formar.serialize()
                        ,done: function(res){
                            table.reload('LAY-app-content-list');
                        }
                    });
                    layer.close(index);

                    //var iframeWindow = window['layui-layer-iframe'+ index]
                    //    ,submit = layero.find('iframe').contents().find("#layuiadmin-app-form-edit");
                    //
                    ////监听提交
                    //iframeWindow.layui.form.on('submit(layuiadmin-app-form-edit)', function(data){
                    //    var field = data.field; //获取提交的字段
                    //
                    //    //提交 Ajax 成功后，静态更新表格中的数据
                    //    //$.ajax({});
                    //    obj.update({
                    //        label: field.label
                    //        ,title: field.title
                    //        ,author: field.author
                    //        ,status: field.status
                    //    }); //数据更新
                    //
                    //    form.render();
                    //    layer.close(index); //关闭弹层
                    //});
                    //
                    //submit.trigger('click');
                }
            });
        } else if(obj.event === 'viee') {
            window.open("/news/"+data.id);
        }
    });



    //=================================================
    //CAT管理
    //=================================================

    table.render({
        elem: '#LAY-app-cat-tags'
        ,url: '/wsite/json/catlist' //模拟接口
        //,url: layui.setter.base + 'json/content/tags.js' //模拟接口
        ,cols: [[
            {type: 'numbers', fixed: 'left'}
            ,{field: 'id', width: 100, title: 'ID', sort: true}
            ,{field: 'chr', title: '标识', minWidth: 100}
            ,{field: 'title', title: '分类名2', minWidth: 100}
            ,{title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#layuiadmin-app-cont-tagsbar'}
        ]]
        ,text: '对不起，加载出现异常！'
    });

    //监听工具条
    table.on('tool(LAY-app-cat-tags)', function(obj){
        var data = obj.data;
        if(obj.event === 'del'){
            layer.confirm('确定删除此分类？', function(index){
                //=====================================
                //shanchu
                //=====================================
                //提交修改
                var data = obj.data;
                admin.req({
                    url: '/wsite/json/catdelete'
                    ,type:'POST'
                    ,data: 'id='+data.id
                    ,success: function(res){
                    }
                });
                obj.del();
                //=====================================
                //layer.msg(data.id);
                layer.close(index);
            });
        } else if(obj.event === 'edit'){
            var tr = $(obj.tr);
            layer.open({
                type: 2
                ,title: '编辑分类'
                ,content: '/wsite/cat/edit?id='+ data.id
                ,area: ['650px', '400px']
                ,btn: ['确定', '取消']
                ,yes: function(index, layero){
                    //获取iframe元素的值
                    //============================================
                    var formar = layero.find('iframe').contents().find("#layuiadmin-app-form-cat");
                    //============================================
                    admin.req({
                        url: '/wsite/json/catedit'
                        ,type:formar.attr("method")
                        ,data: formar.serialize()
                        ,done: function(res){
                            table.reload('LAY-app-cat-tags');
                        }
                    });
                    layer.close(index);
                }
                //,success: function(layero, index){
                //    //给iframe元素赋值
                //    var othis = layero.find('iframe').contents().find("#layuiadmin-app-form-tags").click();
                //    othis.find('input[name="tags"]').val(data.tags);
                //}
            });
        }
    });



    //=================================================
    //碎片管理
    //=================================================

    table.render({
        elem: '#LAY-app-sp-tags'
        ,url: '/wsite/json/splist' //模拟接口
        //,url: layui.setter.base + 'json/content/tags.js' //模拟接口
        ,cols: [[
            {type: 'numbers', fixed: 'left'}
            ,{field: 'id', width: 100, title: 'ID', sort: true}
            ,{field: 'chr', title: '标识', minWidth: 100}
            ,{field: 'title', title: '分类名2', minWidth: 100}
            ,{title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#layuiadmin-app-cont-tagsbar'}
        ]]
        ,text: '对不起，加载出现异常！'
    });

    //监听工具条
    table.on('tool(LAY-app-sp-tags)', function(obj){
        var data = obj.data;
        if(obj.event === 'del'){
            layer.confirm('确定删除此分类？', function(index){
                //=====================================
                //shanchu
                //=====================================
                //提交修改
                var data = obj.data;
                admin.req({
                    url: '/wsite/json/spdelete'
                    ,type:'POST'
                    ,data: 'id='+data.id
                    ,success: function(res){
                    }
                });
                obj.del();
                //=====================================
                //layer.msg(data.id);
                layer.close(index);
            });
        } else if(obj.event === 'edit'){
            var tr = $(obj.tr);
            layer.open({
                type: 2
                ,title: '编辑分类'
                ,content: '/wsite/sp/edit?id='+ data.id
                ,area: ['650px', '400px']
                ,btn: ['确定', '取消']
                ,yes: function(index, layero){
                    //============================================
                    //获取iframe元素的值
                    //============================================
                    var formar = layero.find('iframe').contents().find("#layuiadmin-app-form-sp");
                    //============================================
                    admin.req({
                        url: '/wsite/json/spedit'
                        ,type:formar.attr("method")
                        ,data: formar.serialize()
                        ,done: function(res){
                            table.reload('LAY-app-sp-tags');
                        }
                    });


                    layer.close(index);
                }
                //,success: function(layero, index){
                //    //给iframe元素赋值
                //    var othis = layero.find('iframe').contents().find("#layuiadmin-app-form-tags").click();
                //    othis.find('input[name="tags"]').val(data.tags);
                //}
            });
        }
    });


    exports('wsite', {})
});