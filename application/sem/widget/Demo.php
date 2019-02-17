<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/10/19
 * Time: 11:02
 */
namespace app\example\widget;

use think\Controller;

class Demo extends Controller
{
    public function index()
    {
//        $list = 'ceshi';
//        $this->assign('list',$list);
        return $this->fetch('widget/index');
    }
}


