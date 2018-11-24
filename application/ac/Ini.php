<?php
/*
 * 调试模式下，初始化执行
 * 遍历每个模块，读取数据，生成相应文件
 */

namespace app\ac;

use think\Model;
use think\Cookie;
use think\Request;

class Ini{

    public function __construct(){
    }

    public function getEsb()
    {
        $filepath = APP_PATH;
        $file = $filepath.'config_esb.php';
        $ar = [];
        if (file_exists($file)) {             // $dname 路径名
            $nr = @file_get_contents($file);
            $ar = \json_decode($nr,true);
            $ar = is_array($ar)?$ar:[];
        }
        return $ar;
    }

    public function runDevelomentEsb()
    {
        //调试模式下
        $mconfig = [];
        //========================================================
        $filepath = APP_PATH;
        $dir = opendir($filepath);
        while($dname = readdir($dir)) {
            if ($dname != "." && $dname != "..") {
                $file = rtrim($filepath, DS) . DS . $dname . DS . 'config.php';


                if (file_exists($file)) {             // $dname 路径名
                    $_mconfig = @include($file);
                    if (isset($_mconfig['Esb'])) {
                        $_mconfig = $_mconfig['Esb'];
                        $_mconfig = is_array($_mconfig)?$_mconfig:[];
                        $mconfig = array_merge($mconfig, $_mconfig);
                    }
                }
            }
        }
        if(!file_exists(APP_PATH . 'config_esb.php')){
            @file_put_contents(APP_PATH . 'config_esb.php', json_encode($mconfig));
        }
    }


    public function runDevelomentMdo()
    {
    }


    public function run()
    {
        echo '12121';
        return '1234567890-';

        return true;
    }

}