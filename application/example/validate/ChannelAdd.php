<?php
namespace app\sys\validate;

use think\Validate;

class ChannelAdd extends Validate
{
    protected $rule = [
    'title'  =>  'require',
    'chr' =>  'require',
    ];

    protected $message  =   [
        'title.require' => '名称必须',
        'chr.require'  => '字符必须',
    ];
}