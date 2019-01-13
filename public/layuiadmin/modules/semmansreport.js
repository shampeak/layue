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
    ,toolbar: '#toolbarDemo'
    ,title: '用户数据表'
      ,totalRow: true           //开启count
      ,cols: [[
      //{type: 'checkbox', fixed: 'left'}
      {field: 'uId', width: 100, title: 'ID', sort: true}
      ,{field: 'name', title: '用户名', minWidth: 100,  totalRow: true }
      ,{field: 'groupName', title: '用户组', width: 100}
      ,{field: 'mobile', title: '手机'}
      ,{field: 'email', title: '邮箱'}
      ,{field: 'sex', width: 80, title: '性别', templet: '#usexTpl'}
      ,{field: 'ip', title: 'IP'}
      ,{field: 'jointime', fixed: 'right',title: '加入时间', sort: true}
//      ,{title: '操作',fixed: 'left', width: 150, align:'center', fixed: 'right', toolbar: '#table-useradmin-webuser'}
    ]]
    ,page: true
    ,limit: 30
    ,height: 'full-40'
    ,text: '对不起，加载出现异常！',
    done: function (res, curr, count) {
        //结果集合修正
        //根据check 判断隐藏哪些
        //隐藏部分数据
        //$("[data-field=name]").hide();

        //if(res.success){
            //setCookie("from",$("#from").val());
            //setCookie("to",$("#to").val());
            //alert(1111);
//        }
        //$("input[name='ticket_seat']").each(function () {
        //    $(this).prop("checked") ? $("[data-field=" + $(this).val() + "]").show() : $("[data-field=" + $(this).val() + "]").hide();
        //});
        //layer.close(load);
        //if (count === 0) {
        //    layer.msg(res.msg);
        //    if(res.msg === '请输入有效的站点数据'){
        //        $("#from").css("border-color","red");
        //        $("#to").css("border-color","red");
        //    }
        //}

    }
  });

    function reloadTable() {
        var load = layer.load(2, {time: 60 * 1000});
        var ticket_train_checked = '';
        $("input[name='ticket_train']:checked").each(function (index, item) {
            ticket_train_checked += $(this).val() + ",";
        });
        table.render({
            elem: '#ticket_table',
            url: '/query/getTicket',
            cols: [[
                {field: 'stationTrainCode', title: '车次', align: 'center', minWidth: 100, fixed: 'left', templet: '#stationDetail', event: 'station'}
                , {field: 'fromStationCode', title: '出发地', align: 'center', minWidth: 120, templet: '#fromStationCode', event: 'stationDetailFrom'}
                , {field: 'toStationCode', title: '目的地', align: 'center', minWidth: 120, templet: '#toStationCode', event: 'stationDetailTo'}
                , {field: 'startTime', title: '发车时间', align: 'center', minWidth: 120, sort: true, templet: '#startTime'}
                , {field: 'duration', title: '历时', align: 'center', minWidth: 90, sort: true, templet: '#duration'}
                , {field: 'arriveTime', title: '到达时间', align: 'center', minWidth: 120, sort: true, templet: '#arriveTime'}
                , {field: 'swz', title: '商务', align: 'center', minWidth: 82, templet: '#seatSwz', event:'buy'}
                , {field: 'tz', title: '特等', align: 'center', minWidth: 82, templet: '#seatTz', event:'buy'}
                , {field: 'zy', title: '一等', align: 'center', minWidth: 82, templet: '#seatZy', event:'buy'}
                , {field: 'ze', title: '二等', align: 'center', minWidth: 82, templet: '#seatZe', event:'buy'}
                , {field: 'gr', title: '高软', align: 'center', minWidth: 82, templet: '#seatGr', event:'buy'}
                , {field: 'rw', title: '软卧', align: 'center', minWidth: 82, templet: '#seatRw', event:'buy'}
                , {field: 'srrb', title: '动卧', align: 'center', minWidth: 82, templet: '#seatSrrb', event:'buy'}
                , {field: 'yw', title: '硬卧', align: 'center', minWidth: 82, templet: '#seatYw', event:'buy'}
                , {field: 'rz', title: '软座', align: 'center', minWidth: 82, templet: '#seatRz', event:'buy'}
                , {field: 'yz', title: '硬座', align: 'center', minWidth: 82, templet: '#seatYz', event:'buy'}
                , {field: 'wz', title: '无座', align: 'center', minWidth: 82, templet: '#seatWz', event:'buy'}
                , {field: 'qt', title: '其他', align: 'center', minWidth: 82, templet: '#seatQt', event:'buy'}
                , {field: 'buttonTextInfo', title: '备注', align: 'center', minWidth: 100}
                , {fixed: 'right', title: '抢票方式', width: 120, align: 'center', toolbar: '#work'}
            ]],
            id: 'init_ticket',
            height: 'full-295',
            page: true,
            limit: 100,
            limits: [100],
            text: {
                none: '没有查询到相关车次，请检查后重试'
            },
            skin: 'line',
            initSort: {
                field: 'startTime',
                type: 'asc'
            },
            loading: false,
            where: {
                from: $('#from').val(),
                to: $('#to').val(),
                date: $('#startDate').val(),
                type: $("input[name='ticket_type']:checked").val(),
                ticketTrainArray: ticket_train_checked,
                timeRange: $('#timeRange option:selected').val()
            },
            done: function (res, curr, count) {
                if(res.success){
                    setCookie("from",$("#from").val());
                    setCookie("to",$("#to").val());
                }
                $("input[name='ticket_seat']").each(function () {
                    $(this).prop("checked") ? $("[data-field=" + $(this).val() + "]").show() : $("[data-field=" + $(this).val() + "]").hide();
                });
                layer.close(load);
                if (count === 0) {
                    layer.msg(res.msg);
                    if(res.msg === '请输入有效的站点数据'){
                        $("#from").css("border-color","red");
                        $("#to").css("border-color","red");
                    }
                }

            }
        });
    }



    var init = {
        listen: function () {
            table.on('row(ticket)', function (obj) {
                obj.tr.addClass('click_ticket_table').siblings().removeClass('click_ticket_table');
            });
            ['all', 'c', 'g', 'd', 'z', 't', 'k', 'o'].forEach(function (value) {
                form.on('checkbox(ticket_train_' + value + ')', function (data) {
                    layer.msg(data.elem.checked ? '添加了' + data.elem.title : '排除了' + data.elem.title, {offset: '200px'});
                    if (data.value === 'all') {
                        $("input[name='ticket_train']").prop('checked', data.elem.checked);
                    } else if (data.value !== 'all') {
                        var checked_flag = true;
                        $("input[name='ticket_train']").not('#ticket_train_all').each(function (index, value) {
                            if (!value.checked) checked_flag = false;
                        });
                        $('#ticket_train_all').prop('checked', checked_flag)
                    }
                    form.render();
                    reloadTable()
                });
            });
            ['all', 'swz', 'tz', 'zy', 'ze', 'gr', 'rw', 'srrb', 'yw', 'rz', 'yz', 'wz', 'qt'].forEach(function (value) {
                form.on('checkbox(ticket_seat_' + value + ')', function (data) {
                    layer.msg(data.elem.checked ? '添加了' + data.elem.title : '排除了' + data.elem.title, {offset: '400px'});
                    if (data.value === 'all') {
                        $("input[name='ticket_seat']").prop('checked', data.elem.checked);
                        ['swz', 'tz', 'zy', 'ze', 'gr', 'rw', 'srrb', 'yw', 'rz', 'yz', 'wz', 'qt'].forEach(function (value1) {
                            data.elem.checked ? $("[data-field=" + value1 + "]").show() : $("[data-field=" + value1 + "]").hide()
                        })
                    } else if (data.value !== 'all') {
                        var checked_flag = true;
                        $("input[name='ticket_seat']").not('#ticket_seat_all').each(function (index, value) {
                            if (!value.checked) checked_flag = false;
                            value.checked ? $("[data-field=" + value.value + "]").show() : $("[data-field=" + value.value + "]").hide()
                        });
                        $('#ticket_seat_all').prop('checked', checked_flag);
                    }
                    form.render();
                });
            });
        }
    };



  exports('semmansreport', {})
});