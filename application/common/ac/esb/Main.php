<?php
namespace app\common\ac\esb;

use think\Model;
use think\Cookie;
use think\Request;

/*
 * 无成本获取环境变量和参数
 */

class Main extends Base{

    public $my;

    public function __construct(){
        //注册所有的ads
        $this->my = esb('my');
    }

    public function getHavenewmessage(){
        return false;
    }


    /*
     * 菜单
     */
    public function getMenu(){
        //
        $indexlist = md('adsindex')->where('hidden',0)->order('sort','desc')->select();
        foreach($indexlist as $key=>$value) {
            $indexlist[$key] = $value->toArray();
        }
        $tree = [];
        foreach($indexlist as $key=>$value){
            if($value['pId'] ==0){
                $tree[] = $value;
            }
        }

        //
        foreach($tree  as $key=>$value){
            foreach($indexlist as $k=>$v){
                if($value['Id'] == $v['pId']){
                    $tree[$key]['child'][] = $v;
                }
            }
        }
        //================================================
        $adslist = md('ads')->where('menulevel','<>',0)->where('enable',1)->where('hidden',0)->order('sort','desc')->select();
        $adstree = [];
        foreach($adslist as $key=>$value){
            $adstree[$value['pId']][] = $value->toArray();
        }
        //================================================
        foreach($tree as $key=>$value){
            if(!isset($value['child']) &&  isset($adstree[$value['Id']])){
                $tree[$key]['child'] = $adstree[$value['Id']];
            }else{
                if(isset($value['child'])){
                    foreach($value['child'] as $k=>$v){
                        if(isset($adstree[$v['Id']])) {
                            $tree[$key]['child'][$k]['child'] = $adstree[$v['Id']];
                        }
                    }
                }
            }

        }
//        print_r($tree);
        return $tree;
    }

    /*
     * 后台title
     */
    public function getHometitle(){
        return 'Sadm std - 后台管理';
    }

    public function getFuntitle(){
        //检索DS 获取到title
        return 'Ads';
    }

    /*
     *后台左上显示的字符
     */
    public function getHomelogochr(){
        return 'Sadm';
    }

    /*
     * 默认的打开页面，console 页面或者welcome页面
     */
    public function getHomeurl(){
        return $this->my['root'];
    }

    /*
     * 用户真实姓名
     */
    public function getTruename(){
        return $this->my['truename'];
    }

    /*
     * 测试调试阶段加载的菜单，调试结束之后去掉
     */
    public function getMenudemo(){
//        return [];
        return @include_once(APP_PATH . 'eMenu.php');
    }

}

