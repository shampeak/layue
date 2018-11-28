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
    var $body = $('body');


    /*
     * 修改菜单
     *
     */
    $body.on('click', '.super_menu_editfun', function(obj){
        var id = $(this).attr('data-value');

        layer.open({
            type: 2
            ,title: '编辑Menu'
            ,content: '/super/menu/editfun?id='+id
            ,area: ['750px', '450px']
            ,btn: ['确定', '取消']
            ,yes: function(index, layero){
                //获取iframe元素的值
                //============================================
                var formar = layero.find('iframe').contents().find("#layuiadmin-app-form-menuedit");
                //============================================
                admin.req({
                    url: '/super/json/menueditfun'
                    ,type:formar.attr("method")
                    ,data: formar.serialize()
                    ,done: function(res){
                        layer.close(index);
                        location.reload();
                    }
                });

                layer.close(index);
            }
            ,success: function(layero, index){
            }
        })
    });

    /*
     * 修改菜单
     *
     */
    $body.on('click', '.super_menu_editads', function(obj){
        var id = $(this).attr('data-value');

        layer.open({
            type: 2
            ,title: '编辑Menu'
            ,content: '/super/menu/editads?id='+id
            ,area: ['420px', '550px']
            ,btn: ['确定', '取消']
            ,yes: function(index, layero){
                //获取iframe元素的值
                //============================================
                var formar = layero.find('iframe').contents().find("#layuiadmin-app-form-menueditads");
                //============================================
                admin.req({
                    url: '/super/json/menueditads'
                    ,type:'POST'
                    ,data: formar.serialize()
                    ,done: function(res){
                        layer.close(index);
                        location.reload();
                    }
                });

                layer.close(index);
            }
            ,success: function(layero, index){
            }
        })
    });


    /*
     * 修改菜单
     *
     */
    $body.on('click', '.super_menu_edit', function(obj){
        var id = $(this).attr('data-value');

        layer.open({
            type: 2
            ,title: '编辑Menu'
            ,content: '/super/menu/edit?id='+id
            ,area: ['420px', '450px']
            ,btn: ['确定', '取消']
            ,yes: function(index, layero){
                //获取iframe元素的值
                //============================================
                var formar = layero.find('iframe').contents().find("#layuiadmin-app-form-menuedit");
                //============================================
                admin.req({
                    url: '/super/json/menuedit'
                    ,type:formar.attr("method")
                    ,data: formar.serialize()
                    ,done: function(res){
                        layer.close(index);
                        location.reload();
                    }
                });

                layer.close(index);
            }
            ,success: function(layero, index){
            }
        })
    });







    $body.on('click', '.super_menu_delete', function(obj){
        var id = $(this).attr('data-value');

        layer.confirm('确定删除选中的Ads吗？', function(index){
            admin.req({
                url: '/super/json/menudelete'
                ,type:'GET'
                ,data: 'id='+id
                ,success: function(res){
                }
            });
            //此处只是演示，实际应用需把下述代码放入上述Ajax回调中
            layer.msg('删除成功', {
                icon: 1
            });
//
            //parent.location.reload();
            location.reload();
            layer.close(index);
            //table.reload(thisTabs.id); //刷新表格
        });

    });



    //=================================================================
  //Ads管理
  table.render({
    elem: '#LAY-ads-manage'
    ,url: '/super/json/adslist' //模拟接口
    ,cols: [[
      {field: 'adsId',width:80, title: 'ID', sort: true}
      ,{field: 'ads', title: 'Ads'}
      ,{field: 'title', title: '名称'}
      ,{field: 'icon', width:80, title: '图标', toolbar: '#table-ads-icon'}
          ,{field: 'hidden', width:80, title: '隐藏', sort: true}
          ,{field: 'enable',width:80,  title: '有效', sort: true}
          ,{field: 'menulevel',width:80,  title: '菜单', sort: true}
          ,{field: 'type',width:80,  title: '鉴权', sort: true}
      //,{field: 'check', title:'审核状态', templet: '#buttonTpl', minWidth: 80, align: 'center'}
      ,{title: '操作', width: 150, align: 'center', fixed: 'right', toolbar: '#table-ads-manage'}
    ]]
    ,text: '对不起，加载出现异常！'
  });
  
  //监听工具条
  table.on('tool(LAY-ads-manage)', function(obj){
    var data = obj.data;
    if(obj.event === 'del'){
        layer.confirm('确定删除选中的Ads吗？', function(data){
            var data = obj.data;
            admin.req({
                url: '/super/json/adsdelete'
                ,type:'GET'
                ,data: 'id='+data.adsId
                ,success: function(res){
                }
            });
            //此处只是演示，实际应用需把下述代码放入上述Ajax回调中
            layer.msg('删除成功', {
                icon: 1
            });
            obj.del();
            layer.close(data.index);
            //table.reload(thisTabs.id); //刷新表格
        });

    }else if(obj.event === 'edit'){
      var tr = $(obj.tr);
        var data = obj.data;
      layer.open({
        type: 2
        ,title: '编辑Ads'
        ,content: '/super/ads/edit?id='+data.adsId
        ,area: ['420px', '600px']
        ,btn: ['确定', '取消']
        ,yes: function(index, layero){
              //获取iframe元素的值
              //============================================
              var formar = layero.find('iframe').contents().find("#layuiadmin-app-form-adsedit");
              //============================================
              admin.req({
                  url: '/super/json/adsedit'
                  ,type:formar.attr("method")
                  ,data: formar.serialize()
                  ,done: function(res){
                      table.reload('LAY-ads-manage');
                  }
              });
              layer.close(index);
        }
        ,success: function(layero, index){           
        }
      })
    }
  });

  exports('super', {})
});