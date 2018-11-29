<?php
namespace app\common\model;

use think\Request;

/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/26
 * Time: 15:39
 */
class Base extends \think\Model
{

    public static $base_url;

    /**
     * 模型基类初始化
     */
    public static function init()
    {
        parent::init();
        // 获取当前域名
        self::$base_url = base_url();
        // 后期静态绑定wxapp_id
    }

    /**
     * 获取当前调用的模块名称
     * 例如：admin, api, store, task
     * @return string|bool
     */
    protected static function getCalledModule()
    {
        if (preg_match('/app\\\(\w+)/', get_called_class(), $class)) {
            return $class[1];
        }
        return false;
    }

    /**
     * 获取当前域名
     * @return string
     */
    protected static function baseUrl()
    {
        $request = Request::instance();
        $host = $request->scheme() . '://' . $request->host();
        $dirname = dirname($request->baseUrl());
        return empty($dirname) ? $host : $host . $dirname . '/';
    }

}