<?php
/**
 * 示例：
 * <?php
 * require_once("pager.class.php");
 * $subPages=new pager($totalPage,$currentPage);
 * echo $subPages->showpager();
 * ?>
 * */
class Pager{
    var $each_disNums;  //每页显示的条目数
    var $url;           //去除page的地址
    var $nums;          //总条目数
    var $current_page;  //当前被选中的页
    var $sub_pages;     //每次显示的页数
    var $pageNums;      //总页数

    var $page_array = array();//用来构造分页的数组
    var $subPage_link;//每个分页的链接
    var $subPage_type;//显示分页的类型
    var $_lang = array(
        'index_page' => '首页',
        'pre_page' => '上一页',
        'next_page' => '下一页',
        'last_page' => '尾页',
        'current_page' => '当前页：',
        'total_page' => '总页数：',
        'current_show' => '当前显示：',
        'total_record' => '总记录数：'
    );
    public $pagePre = 1;
    public $pageNext = 1;
    /*
    __construct是SubPages的构造函数，用来在创建类的时候自动运行.
    @total_page 总页数
    @current_num 当前被选中的页
    @sub_pages 每次显示的页数
    @subPage_link 每个分页的链接
    @subPage_type 显示分页的类型

    当@subPage_type=1的时候 www.phpfensi.com 为普通分页模式
    example： 共4523条记录,每页显示10条,当前第1/453页 [首页] [上页] [下页] [尾页]
    当@subPage_type=2的时候为经典分页样式
    example： 当前第1/453页 [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页]
    */
//    function __construct($total_page,$current_page,$sub_pages=10,$subPage_link='',$subPage_type=2){
//    $this->pager($total_page,$current_page,$sub_pages,$subPage_link,$subPage_type);
//    function __construct($total_page,$current_page,$sub_pages=10,$subPage_link='',$subPage_type=2){
    function __construct(){
        $page=isset($_GET['page'])?intval($_GET['page']):1;
        $page = ($page<1)?1:$page;
        $each_disNums = isset($_GET['pagesize'])?intval($_GET['pagesize']):50;
        $each_disNums = ($each_disNums<10)?10:$each_disNums;


        $url = '';
        if(!$url){ $url=$_SERVER["REQUEST_URI"];}
        $parse_url=parse_url($url);
        @$url_query=$parse_url["query"];    //取出在问号?之后内容
        if($url_query){
            $url_query=preg_replace("/(&?)(page=$page)/","",$url_query);
            $url = str_replace($parse_url["query"],$url_query,$url);
            if($url_query){
                $url .= "&page=";
            }else $url .= "page=";
        }else $url .= "?page=";

        $this->url = $url;
        $this->page = $page;
        $this->each_disNums = $each_disNums;
    }

    function pager($num,$current_page=10,$sub_pages=10,$subPage_link='',$subPage_type=2){
        if(!$current_page){
            $this->current_page=1;
        }else{
            $this->current_page=intval($current_page);
        }

        $this->sub_pages=intval($sub_pages);
        $this->nums = $num;

//        $this->pageNums=ceil($total_page);

        if($subPage_link){
            if(strpos($subPage_link,'?page=') === false AND strpos($subPage_link,'&page=') === false){
                $subPage_link .= (strpos($subPage_link,'?') === false ? '?' : '&') . 'page=';
            }
        }

        //$this->subPage_link=$subPage_link ? $subPage_link : $this->url;
        $this->subPage_link= $this->url;
        $this->subPage_type = $subPage_type;


        $this->pageNums = ceil($this->nums/$this->each_disNums);
        $this->sub_pages = ($this->sub_pages>$this->pageNums)?$this->pageNums:$this->sub_pages;

//        echo $this->each_disNums;  //每页显示的条目数
//        echo "每页显示的条目数\n\r";
//        echo $this->url;           //去除page的地址
//        echo "去除page的地址\n\r";
//        echo $this->nums;          //总条目数
//        echo "总条目数\n\r";
//        echo $this->current_page;  //当前被选中的页
//        echo "当前被选中的页\n\r";
//        echo $this->sub_pages;     //每次显示的页数
//        echo "每次显示的页数\n\r";
//        echo $this->pageNums;      //总页数
//        echo "总页数\n\r";
        $this->pagePre = $this->current_page -1;
        $this->pagePre = ($this->pagePre <1)?1:$this->pagePre;
        $this->pageNext = $this->current_page + 1;
        $this->pageNext = ($this->pageNext > $this->pageNums)?$this->pageNums:$this->pageNext;


    }

    /*
    show_SubPages函数用在构造函数里面。而且用来判断显示什么样子的分页
    */
    function showpager(){
        //echo $this->subPage_type;
        if($this->subPage_type == 1){
            return $this->pagelist1();
        }elseif ($this->subPage_type == 2){
            return $this->pagelist2();
        }
    }


    /*
    用来给建立分页的数组初始化的函数。
    */
    function initArray(){
        for($i=0;$i<$this->sub_pages;$i++){
            $this->page_array[$i]=$i;
        }
        return $this->page_array;
    }


    /*
    construct_num_Page该函数使用来构造显示的条目
    即使：[1][2][3][4][5][6][7][8][9][10]
    */
    function construct_num_Page(){
        if($this->pageNums < $this->sub_pages){
            $current_array=array();
            for($i=0;$i<$this->pageNums;$i++){
                $current_array[$i]=$i+1;
            }
        }else{
            $current_array=$this->initArray();
            if($this->current_page <= 3){
                for($i=0;$i<count($current_array);$i++){
                    $current_array[$i]=$i+1;
                }
            }elseif ($this->current_page <= $this->pageNums && $this->current_page > $this->pageNums - $this->sub_pages + 1 ){
                for($i=0;$i<count($current_array);$i++){
                    $current_array[$i]=($this->pageNums)-($this->sub_pages)+1+$i;
                }
            }else{
                for($i=0;$i<count($current_array);$i++){
                    $current_array[$i]=$this->current_page-2+$i;
                }
            }
        }

        return $current_array;
    }

    /*
    构造普通模式的分页
    共4523条记录,每页显示10条,当前第1/453页 [首页] [上页] [下页] [尾页]
    */
    function pagelist1(){
        $this->subPage_link = $this->url;
        $subPageCss1Str="";
        $subPageCss1Str.= $this->_lang['current_page'] . $this->current_page." / " .$this->pageNums."   ";
        if($this->current_page > 1){
            $firstPageUrl=$this->subPage_link."1";
            $prewPageUrl=$this->subPage_link.($this->current_page-1);
            $subPageCss1Str.="<a href='$firstPageUrl'>{$this->_lang['index_page']}</a> ";
            $subPageCss1Str.="<a href='$prewPageUrl'>{$this->_lang['pre_page']}</a> ";
        }else {
            $subPageCss1Str.="{$this->_lang['index_page']} ";
            $subPageCss1Str.="{$this->_lang['pre_page']} ";
        }

        if($this->current_page < $this->pageNums){
            $lastPageUrl=$this->subPage_link.$this->pageNums;
            $nextPageUrl=$this->subPage_link.($this->current_page+1);
            $subPageCss1Str.=" <a href='$nextPageUrl'>{$this->_lang['next_page']}</a> ";
            $subPageCss1Str.="<a href='$lastPageUrl'>{$this->_lang['last_page']}</a> ";
        }else {
            $subPageCss1Str.="{$this->_lang['next_page']} ";
            $subPageCss1Str.="{$this->_lang['last_page']} ";
        }

        return $subPageCss1Str;
    }


    /*
    构造经典模式分页
    当前第1/453页 [首页] [上页] 1 2 3 4 5 6 7 8 9 10 [下页] [尾页]
    */
    function pagelist2(){
        $this->subPage_link = $this->url;
        $subPageCss2Str="";
        $subPageCss2Str.=$this->_lang['current_page'] . $this->current_page."/" . $this->pageNums." ";

        if($this->current_page > 1){
            $firstPageUrl=$this->subPage_link."1";
            $prewPageUrl=$this->subPage_link.($this->current_page-1);
            $subPageCss2Str.="<a href='$firstPageUrl'>{$this->_lang['index_page']}</a> ";
            $subPageCss2Str.="<a href='$prewPageUrl'>{$this->_lang['pre_page']}</a> ";
        }else {
            $subPageCss2Str.="{$this->_lang['index_page']} ";
            $subPageCss2Str.="{$this->_lang['pre_page']} ";
        }

        $a=$this->construct_num_Page();
        //echo $this->subPage_link;
        for($i=0;$i<count($a);$i++){
            $s=$a[$i];
            if($s == $this->current_page ){
                $subPageCss2Str.="[<span style='color:red;font-weight:bold;'>".$s."</span>]";
            }else{
                $url=$this->subPage_link.$s;
                $subPageCss2Str.="[<a href='$url'>".$s."</a>]";
            }
        }

        if($this->current_page < $this->pageNums){
            $lastPageUrl=$this->subPage_link.$this->pageNums;
            $nextPageUrl=$this->subPage_link.($this->current_page+1);
            $subPageCss2Str.=" <a href='$nextPageUrl'>{$this->_lang['next_page']}</a> ";
            $subPageCss2Str.="<a href='$lastPageUrl'>{$this->_lang['last_page']}</a> ";
        }else {
            $subPageCss2Str.="{$this->_lang['next_page']} ";
            $subPageCss2Str.="{$this->_lang['last_page']} ";
        }
        return $subPageCss2Str;
    }


    /*
    __destruct析构函数，当类不在使用的时候调用，该函数用来释放资源。
    */
    function __destruct(){
        unset($each_disNums);
        unset($nums);
        unset($current_page);
        unset($sub_pages);
        unset($pageNums);
        unset($page_array);
        unset($subPage_link);
        unset($subPage_type);
    }
}
