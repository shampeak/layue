<?php
namespace app\sys\validate;

use think\Validate;

class UserAdd extends Validate
{
    protected $rule = [
    'name'  =>  'require',
    'password' =>  'require',
        'groupId' =>  'require',
        'trueName' =>  'require',

    ];

    protected $message  =   [
        'name.require'      => '请输入用户名',
        'password.require'  => '请输入密码',
        'groupId.require'  => '请选择用户组',
        'trueName.require'  => '请输入真实姓名',

    ];
}