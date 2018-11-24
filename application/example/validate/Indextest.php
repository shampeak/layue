<?php
namespace app\index\validate;

use think\Validate;

class Indextest extends Validate
{
    protected $rule = [
//    'groupName'  =>  'require',
//    'groupChr' =>  'require',
    ];

    protected $message  =   [
//        'groupName.require' => '组名必须',
//        'groupChr.require'  => '路径必须',
    ];
}