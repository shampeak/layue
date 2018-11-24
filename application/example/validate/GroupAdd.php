<?php
namespace app\sys\validate;

use think\Validate;

class GroupAdd extends Validate
{
    protected $rule = [
    'groupName'  =>  'require',
    'groupChr' =>  'require',
    ];

    protected $message  =   [
        'groupName.require' => '组名必须',
        'groupChr.require'  => '路径必须',
    ];
}