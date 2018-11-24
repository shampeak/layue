<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
// 应用公共文件

    /*
     * //==========================================================
     */
    function esb($ob = null){
        if($ob){
            $ob = ucfirst($ob);
            return \app\ac\esb\Esb::getInstance()->make($ob);
        }else{
            return \app\ac\esb\Esb::getInstance();
        }
    }

    function ac($name)
    {
        $name = ucfirst($name);
        $acname = 'app\ac'.'\\'.$name;
        return model($acname);
    }


function substr_text($str, $start=0, $length, $charset="utf-8", $suffix="")
{
    if(function_exists("mb_substr")){
        return mb_substr($str, $start, $length, $charset).$suffix;
    }
    elseif(function_exists('iconv_substr')){
        return iconv_substr($str,$start,$length,$charset).$suffix;
    }
    $re['utf-8']  = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    return $slice.$suffix;
}


    function event($name,$modelname='')
    {
        $ob = null;
        empty($modelname) && $modelname = \think\Request::instance()->module();
        $eventname = ucfirst($name);
        $classname = 'app\\'.$modelname.'\\event\\'.$eventname;
        if(class_exists($classname)){
            return model($classname);
            //return new $classname();
        }else{
            $classname = 'app\\common\\event\\'.$eventname;
            if(class_exists($classname)){
                return model($classname);
              //  return new $classname();
            }
        }
        return $ob;
    }

    /*
     * 模型调用
     */
    function md($name)
    {
        $name = ucfirst($name);
        $modelname = \think\Request::instance()->module();
        $modelinstance = 'app\\'.$modelname.'\model\\'.$name;
        $modelinstance2 = 'app\model\\'.$name;
        if(class_exists($modelinstance)){
            return model($modelinstance);
        }
        if(class_exists($modelinstance2)){
            return model($modelinstance2);
        }
        die('miss : '.$modelinstance);
    }


    /*
     * 参数trim
     */
    function trims($res){
        if(empty($res)) return $res;
        if(is_object($res)){
            return $res;
        }
        if(is_array($res)){
            foreach($res as $k=>$value){
                if(!is_array($value) && !is_object($value)){
                    $res[$k] = trim($value);
                }else{
                    $res[$k] = $value;
                }
            }
            return $res;
        }else{
            return trim($res);
        }

    }





    function C($key = '',$value=null){
        static $_config = array();
        $args = func_num_args();
        if($args == 1){
            if(is_string($key)){  //如果传入的key是字符串
                return isset($_config[$key])?$_config[$key]:null;
            }
            if(is_array($key)){
                //如果传入的key是关联数组
                if(array_keys($key) !== range(0, count($key) - 1)){
                    $_config = array_merge($_config, $key);
                }else{
                    $ret = array();
                    foreach ($key as $k) {
                        $ret[$k] = isset($_config[$k])?$_config[$k]:null;
                    }
                    return $ret;
                }
            }
        }elseif($args == 2){
            if(is_string($key)){
                $_config[$key] = $value;
            }else{
                die('Params Error!');
            }
        }else{
            return $_config;
        }
        return null;
    }
