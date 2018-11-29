<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/9/3
 * Time: 12:01
 */

//抛出异常的http状态码、异常的信息、自定义异常的状态码(可选)

namespace app\common\exception;

use think\Exception;

/**
 * Class BaseException
 * 自定义异常类的基类
 */
class BaseException extends Exception
{
    public $code = 0;
    public $message = 'invalid parameters';

    /**
     * 构造函数，接收一个关联数组
     * @param array $params 关联数组只应包含code、msg，且不应该是空值
     */
    public function __construct($params = [])
    {
        if (!is_array($params)) {
            return;
        }
        if (array_key_exists('code', $params)) {
            $this->code = $params['code'];
        }
        if (array_key_exists('msg', $params)) {
            $this->message = $params['msg'];
        }
    }
}


//        throw new \app\common\exception\BaseException(['msg' => '缺少必要的参数：wxapp_id']);
