<?php
namespace app\common\ac\esb;

use think\Model;
use think\Cookie;
use think\Request;

/*
 * 无成本获取环境变量和参数
 */

class Ads extends Base{

    public $a;
    public $d;
    public $s;
    public $ads;
    public $list;


    public function __construct(){
        //注册所有的ads
        $this->a = Request::instance()->module();
        $this->d = Request::instance()->controller();
        $this->s = Request::instance()->action();
        $this->list = $this->getMenulist();

    }

    function getTitle(){
        return '';
    }

    function getMain(){
        return '/main';
    }

    function getUrl(){
        $a = strtolower($this->a);
        $d = strtolower($this->d);
        $s = strtolower($this->s);
        return "/$a/$d/$s";
    }

    /*
     * //=====================================
     */
    public function getMenu()
    {
        return [

        ];
    }

    public function getMenutop()
    {
        $list = $this->list;
        $top = [];
        foreach($list as $key=>$value){
            if($value['pId'] ==0){
                array_push($top,$value);
            }
        }
        return $top;
    }



    public function getMenulist()
    {
        $where = "menulevel <> 0 and enable = 1 and hidden = 0";
        $list = md('ads')->where($where)->order('sort','desc')->select();
        foreach($list as $key=>$value){
            $list[$key]=$value->toArray();
        }

        //==============================
        //鉴权
        //==============================
        /*
         * 根据role设置permit 为允许type 为0
         */
        return $list;
    }



}

