<?php

namespace app\main\validate;

use think\Validate;

class Login extends Validate
{
    protected $rule = [
        'username'  =>  'require',
        'password' =>  'require',
    ];

    protected $message  =   [
        'username.require' => '登陆名必须',
        'password.require'=>'密码必须',
    ];

}