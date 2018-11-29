<?php
namespace app\common\ac\esb;

use think\Cookie;
use think\Request;
use think\Cache;

class Base implements \ArrayAccess{

    public $Instances = [];

    public function offsetExists($key)
    {
        return isset($this->Instances[$key]);
    }

    public function offsetSet($key, $value)
    {
        $this->Instances[$key] = $value;
    }

    public function offsetGet($key)
    {
        if(isset($this->Instances[$key])){
            return $this->Instances[$key];
        }else{
            $mothed = 'get'.ucfirst($key);
            $res = $this->$mothed();
            $this->Instances[$key] = $res;
            return $res;
        }
    }

    public function offsetUnset($key)
    {
        unset($this->Instances[$key]);
    }

}
