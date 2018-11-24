/**

 @Name：layuiAdmin 用户登入和注册等
 @Author：贤心
 @Site：http://www.layui.com/admin/
 @License: LPPL

 */

layui.define('form', function(exports){

    var $ = layui.$
        ,setter = layui.setter
        ,admin = layui.admin
        ,form = layui.form
        ,router = layui.router()
        ,layer = layui.layer
        ,laytpl = layui.laytpl
        ,setter = layui.setter
        ,view = layui.view
        ,admin = layui.admin
        ,search = router.search;


    var $body = $('body');

    form.render();
    //提交
    form.on('submit(LAY-user-login-submit)', function(obj){
        //请求登入接口
        admin.req({
            url: '/main/json/login' //实际使用请改成服务端真实接口
            ,data: obj.field
            ,done: function(res){
//                alert(111);
                //请求成功后，写入 access_token
                layui.data(setter.tableName, {
                    //登陆失败，显示数据
                    key: setter.request.tokenName
                    ,value: res.data.access_token
                });

                var ns = $('#LAY-user-login-username').val();
                setcookie('__loginname',ns);

                //登入成功的提示与跳转
                layer.msg('登入成功', {
                    offset: '15px'
                    ,icon: 1
                    ,time: 1000
                }, function(){
                    location.href = '/main'; //后台主页
                });
            }
        });

    });

    //更换图形验证码
    $body.on('click', '#LAY-user-get-vercode', function(){
        var othis = $(this);
        this.src = 'https://www.oschina.net/action/user/captcha?t='+ new Date().getTime()
    });

    //对外暴露的接口
    exports('aelogin', {});
});