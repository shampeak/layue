/*!
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This file should be included in all pages
 !**/


//tip
function tipalert(ob,msg) {
	
	$("#vsham").remove();
	$(ob).append("<div id=\"vsham\" class=\"alert alert-warning\" role=\"alert\" style=\"display:none;\">" +
    "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>" +
    "<div><span style=\"color:black\">"+msg+"</span></div></div>");
	$("#vsham").fadeIn(300);
	$('#vsham').delay(2000).fadeOut(1000);
}


(function ($) {
    $.getUrlParam = function (name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
})(jQuery);

//var xx = $.getUrlParam('reurl');




$(function() {


    ////菜单收缩开关
    //var menutogglestates = getcookie('menutogglestates');
    //function ini(){
    //    if(menutogglestates ==1 ){
    //        $('body').addClass('sidebar-collapse');
    //    }
    //}show
    //$('#menutoggle').click(function(){
    //    var menutogglestates = getcookie('menutogglestates');
    //    if(menutogglestates ==1 ){
    //        setcookie('menutogglestates',3);
    //        $('body').addClass('sidebar-collapse');
    //    }else{
    //        setcookie('menutogglestates',1);
    //        $('body').removeClass('sidebar-collapse');
    //    }
    //});
    //ini();

    //菜单收缩开关
    $('.sidebar-toggle').click(function(){
        setc('vart1');
    });

    //调用
	//formact 删除 toggle
	//formsubmit 排序 addnew update
	$('.formsubmit').click(function(){
		var tag = $(this).attr("rel");
		$.ajax({
			type: "POST", 
			url: $(tag).attr("action"), 
			data: $(tag).serialize(), 
			dataType:'json',
			success: function(data){ 
				var JS = data.js;
				eval(JS);
				},
			error : function() {  
				   alert("异常！");  
			  }  
		});
	});
		
	//删除和变更状态 - 新的集成
	$('.formact').click(function(){
		var confirmmsg =  $(this).attr("confirm");
		if(confirmmsg !== undefined){
			//操作确认
			if (!confirm(confirmmsg)) {
				return false;
			}
		}
		var tag = $(this).attr("tag");
		if(tag == undefined){
			tag = '';
		}	
		$.ajax({ 
			type: "POST", 
			url: tag, 
			data: {
				act : $(this).attr("act"),
				relid : $(this).attr("relid"),
				field : $(this).attr("field"),
				}, 
			dataType:'json',
			success: function(data){ 
				var JS = data.js;
				eval(JS);
				},
			error : function() {  
				   alert("异常！");  
			  }  
		});
	});

	//必须参数 根据rel 选定form
	//shampostform 标记
	//rel 标记
	$('.shampostform').click(function(){
		var tag = $(this).attr("rel");
		$.ajax({ 
			type: "POST", 
			url: $(tag).attr("action"), 
			data: $(tag).serialize(), 
			dataType:'json',
			success: function(data){ 
				var JS = data.js;
				eval(JS);
				},
			error : function() {  
				   alert("异常！");  
			  }  
		});
	});
    //必须参数 根据rel 选定form
    //shampostform 标记
    //rel 标记
    //返回错误信息
    $('.nscpostformerror').click(function(){
        var tag = $(this).attr("rel");
        $.ajax({
            type: "POST",
            url: $(tag).attr("action"),
            data: $(tag).serialize(),
            dataType:'json',
            success: function(data){
                if(data.code==200)eval(data.js);
                var error = eval(data.msg);
                for( var o in error){
                    $("input").each(
                        function(){
                            if($(this).attr("name")== o){
                                $(this).parent().next().children().remove();
                                $(this).parent().next().append("<label class=\"error\" for="+o+" generated=\"true\">"+error[o]+"</label>");
                            }
                        }
                    );
                    $("textarea").each(
                        function(){
                            if($(this).attr("name")== o){
                                $(this).parent().next().children().remove();
                                $(this).parent().next().append("<label class=\"error\" for="+o+"  generated=\"true\">"+error[o]+"</label>");
                            }
                        }
                    );
                }
            },
            error : function() {
                alert("异常！");
            }
        });
    });


    var oblist = $(".shamlist").attr('rel');
    if(oblist != undefined){
        var ob = $('.shamlist');
        var target =  $('.shamlist').attr("rel");
        $.ajax({
            type: "GET",
            url: target,
            dataType:'html',
            beforeSend:function(data){
                $('#filloverlay').remove();
                $('#shamlist').append('<div class="overlay" id="filloverlay"><i class="fa fa-refresh fa-spin"></i></div>');
            },
            complete : function() {
                $('#filloverlay').remove();
            },
            success: function(response){
                ob.html(response);
                var be = response.indexOf('<script type="text/list">');
                var length = response.length;
                var DTs = response.substr(be+25, length-be); // 获取子字符串, 从下表12开始, 截取5个字符
                var be = DTs.indexOf('</script>');
                var njs = DTs.substr(0, be);
                eval(njs);
            },
            error : function() {
                alert("异常！");
            }
        });

    }



    //jQuery('#modal-sham .modal-title').html('');
    //jQuery('#modal-sham .modal-body').html('loading...');
    //jQuery('#modal-sham').modal('show', {backdrop: 'static'});
    //jQuery.ajax({
    //    url: url,
    //    success: function(response)
    //    {
    /*
    |-----------------------------------
    | 下面是整理好的
    |-----------------------------------
     */
    $('.shamfill').click(function(){
        var ob = $(this);
        var url =  $(this).attr("rel");
        var target =  $(this).attr("relid");
        if(target == undefined){
            target = '#shamfill';   //默认的；
        }
        $.ajax({
            type: "GET",
            url: url,
            dataType:'html',
            beforeSend:function(data){
                    $('#filloverlay').remove();
                    $('#shamfill').append('<div class="overlay" id="filloverlay"><i class="fa fa-refresh fa-spin"></i></div>');
            },
            complete : function() {
                    $('#filloverlay').remove();
            },
            success: function(response){
                $(target).html(response);
                var be = response.indexOf('<script type="text/pane">');
                var length = response.length;
                var DTs = response.substr(be+25, length-be); // 获取子字符串, 从下表12开始, 截取5个字符
                var be = DTs.indexOf('</script>');
                var njs = DTs.substr(0, be);
                eval(njs);
            },
            error : function() {
                alert("异常！");
            }
        });
    });



    //shamtoggle
    //like
    //<label class="shamtoggle fa fa-star-o" classre="shamtoggle fa fa-star text-yellow" rel="/i/index/po"></label>
    $('.shamtoggle').click(function(){
        var ob = $(this);
        var url =  $(this).attr("rel");
        console.log(url);
        var thisclass   =  $(this).attr("class");
        var thisclassre =  $(this).attr("classre");
        var _html   = $(this).attr("_html");

       // var ar=url.split('?');


        $.ajax({
            type: "GET",
            url: url,
            //url: ar[0],
            //data:ar[1],
            dataType:'json',
            success: function(data){
                if(data.code>0){
                    ob.attr('classre',thisclass);
                    ob.removeClass(thisclass);
                    ob.addClass(thisclassre);
                    if(_html){
                        ob.attr('_html',ob.html());
                        ob.html(_html);
                    }
                }
            },
            error : function() {
                alert("异常！");
            }
        });
    });


    //删除，按钮，删除本行数据
//
    $('.shamdel').click(function(){
        var ob  =   $(this);
        var url =   $(this).attr("rel");
        var confirmmsg =  $(this).attr("comfirm");
        //操作确认
        if(confirmmsg !== undefined){
            if (!confirm(confirmmsg)) {
                return false;
            }
        }
        $.ajax({
            type: "GET",
            url: url,
            dataType:'json',
            beforeSend: function () {
                ob.html('doing');
                ob.attr({ disabled: "disabled" });
            },
            success: function(data){
                if(data.code>0){
                    ob.parent().parent("tr").remove();
                }
            },
            complete: function () {
                //ob.removeAttr("disabled");
            },
            error : function() {
                alert("异常！");
            }
        });
    });

    //like
    //<a class="shamget" rel="/api/list/delete?id={$item['apiId']}" comfirm="是否删除?">删除</a>
    $('.shamget').click(function(){
        var url =  $(this).attr("rel");
        var confirmmsg =  $(this).attr("comfirm");
        //操作确认
        if(confirmmsg !== undefined){
            if (!confirm(confirmmsg)) {
                return false;
            }
        }
        $.ajax({
            type: "GET",
            url: url,
            dataType:'json',
            success: function(data){
                var JS = data.js;
                eval(JS);
            },
            error : function() {
                alert("异常！");
            }
        });
    });

    /**
     * 调用cookie函数
     * 实现页面开关
     */
    $(".trigercookie").on('ifClicked', function(event){
        var rel = event.currentTarget.attributes.rel.nodeValue;
        setc(rel);
        location.reload();
    });

    $('.shambox').click(function(){
        var title = $(this).attr("title")
        var url = $(this).attr("rel")

        $('.modal_ok').unbind("click");
        if ( $("#modal-shamL").length > 0 ) {
        } else {
            $(document.body).append("<!-- Modal sham (Ajax Modal)-->" +
            "<div class=\"modal fade\" id=\"modal-shamL\">" +
            "<div class=\"modal-dialog modal-lg\" style=\"width:60%\">" +
            "<div class=\"modal-content\">" +
            "<div class=\"modal-header\">" +
            "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>" +
            "<h4 class=\"modal-title\">Title</h4></div>" +
            "<div class=\"modal-body\">Content is loading...</div>" +
            "<div class=\"modal-footer\">" +
            "<button type=\"button\" class=\"btn btn-white modal_close\" data-dismiss=\"modal\">关闭</button>" +
            "</div></div></div></div>");
        }
        jQuery('#modal-shamL .modal-title').html('');
        jQuery('#modal-shamL .modal-body').html('loading...');
        jQuery('#modal-shamL').modal('show', {backdrop: 'static'});
        jQuery.ajax({
            url: url,
            success: function(response)
            {
                jQuery('#modal-shamL .modal-title').html(title);
                jQuery('#modal-shamL .modal-body').html(response);
                var JS = $("script[type='text/dialog']").html();
                eval(JS);
            }
        });

    });

});


/**
 * 对cookies的操作
 * @param name
 * @param value
 * @param days
 */
function setcookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		var expires = "; expires=" + date.toGMTString();
	}
	else var expires = "";
	document.cookie = name + "=" + value + expires + "; path=/";
}

function getcookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function setc(name){
	var is = getcookie(name);
	if(is == 1){
		var ns = 0;
	}else{
		var ns = 1;
	}
	setcookie(name,ns,1000);
}
