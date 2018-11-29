<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-01-05
 * Time: 17:27
 */

namespace app\common\ac\esb;

class Esb extends Base{

    private static $_instance = null;       //单例调用
    //服务对象配置信息存储
    public $Providers = [
    ];

    //服务对象存储 映射
    //对象实例
    public $Instances = array();             //服务对象存储 实例

    private function __construct()
    {
        $this->Providers = @include_once(APP_PATH . 'esbConfig.php');
    }

    static function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function make($abstract, $parameters = [])
    {
        $abstract = ucfirst($abstract);
        if (isset($this->Instances[$abstract])) {
            return $this->Instances[$abstract];
        }

        //未定义的服务类 返回空值;
        if (!isset($this->Providers[$abstract])) {
            die('Miss Esb : '.$abstract);
            return null;
        }

        // echo $abstract;
        $this->Instances[$abstract] = $this->build($abstract, $parameters);
        return $this->Instances[$abstract];
    }

    /**
     */
    private function build($abstract, $parameters = [])
    {
        $obj_ = $this->Providers[$abstract];
        $obj = new $obj_($parameters);
        return $obj;
    }

    public function offsetGet($key)
    {
        $abstract = ucfirst($key);
        if (isset($this->Instances[$abstract])) {
            return $this->Instances[$abstract];
        }

        //未定义的服务类 返回空值;
        if (!isset($this->Providers[$abstract])) {
            die('Miss Esb : '.$abstract);
            return null;
        }

        // echo $abstract;
        $this->Instances[$abstract] = $this->build($abstract);
        return $this->Instances[$abstract];

    }


}


