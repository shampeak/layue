<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-01-05
 * Time: 17:27
 */

namespace app\common\ac;

use think\Model;

class Password {

    public $options = [];

    public function __construct(){
        $this->options = [
            'salt' => $this->getSalt(), //自定义函数来获得盐值
            'cost' => 12 // the default cost is 10
        ];
    }

    public function getSalt()
    {
        return "XGEzrsr4DdbY85he8ODdbY85he8OnLs";
    }

    public function getHash($password)
    {
        $hash = \password_hash($password, PASSWORD_DEFAULT, $this->options);
        return $hash;
    }

    public function verify($password,$hash)
    {
        if (\password_verify($password, $hash)) {
            // Pass
            return true;
        }
        else {
            return false;
            // Invalid
        }
    }

}