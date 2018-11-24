# Readme 【全系统】

---


## <font color=red>开发中的约定</font>
> 在控制器中，判断是否由Post提交过来的

    //时间处理
    {$item['closeAt']|date="Y-m-d H:i:s",###}


    //动作判断
    if($request->isPost()){
        $action = $request->action().'Post';
        return $this->$action($request);
    }

    //初始js代码
    <script type="text/javascript">
        $(document).ready(function(){
        
            $('#addset').click(function(){
                var tag = '#addsetform';
                $.ajax({
                    type: "Post",
                    url: $(tag).attr("action"),
                    dataType:'json',
                    data:$(tag).serialize(),
                    success: function(data){
                        if(data.code==200){
                            location.reload();
                        }else{
                            tipalert('#modeltipadd',data.msg);
                        }
                    },
                    error : function() {
                        alert("异常！");
                    }
                });
            });
            
        });
    </script>

    //边距控制
    no-padding
    
    //页面toggle
    {$value['flit']|toggle='过滤:btn-sm btn-info','有效:btn-sm btn-danger','/tools/ads/flit##id='.$value['Id']}
    {$value['flit']|toggle=':glyphicon glyphicon-ok text-navy',':glyphicon glyphicon-remove text-danger','/tools/ads/flit##id='.$value['Id']}
    {$value['Id']|btn='删除','shamdel btn btn-xs btn-info','/tools/ads/delete##id='.$value['Id']}

    //控制器初始化执行

    public $chr = '';
    public $Islogin = false;
    public $ads = '';
    ---
    $this->chr      = Request::instance()->module();
    $this->IsLogin  = bsb('Auth')['IsLogin'];
    $this->ads      = bsb('Env')['Ads'];

    //开发模式
    if (bsb('Env')['Isdebug']) {
        ac('Ini')->run();
        ac('Ads')->register(ucfirst($this->chr));
    }
    if (!$this->IsLogin) {
        $this->redirect(bsb('Env')['LoginRoot']);
    }
    //权限
    if(!ac('Ads')->checkads()){
        die();
    }


