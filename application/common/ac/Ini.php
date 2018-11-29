<?php
/*
 * 调试模式下，初始化执行
 * 遍历每个模块，读取数据，生成相应文件
 */

namespace app\common\ac;

use think\Model;
use think\Cookie;
use think\Request;

class Ini{

    public function __construct(){
    }

    public function run($type = '0')
    {
        echo '11231244';
    }

    public function register($type = '0')        //$type 鉴权方式 0:allow/1:permit/2:deny
    {
        $ads = esb()['env']['ads'];
        $method = esb()['Env']['Method'];

        $str = trim($ads,'/');
        $ar = explode('/',$str);
        $a = $d = $s = '';
        $a = array_shift($ar);
        if($ar) $d = array_shift($ar);
        if($ar) $s = array_shift($ar);

        $row = \app\common\model\Ads::where([
            'ads'   => $ads,
        ])->find();
        if(empty($row)){
            \app\common\model\Ads::insert([
                'ads'   => $ads,
                'a'   => $a,
                'd'   => $d,
                's'   => $s,
                'type'  => $type,
            ]);
        }
        return true;
    }

}