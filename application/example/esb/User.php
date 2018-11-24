<?php
namespace app\tools\esb;

use think\Model;
use think\Cookie;
use think\Request;
use app\model\Zsaccount;
use app\model\Zsxm;
use app\model\Ly;
use app\model\Tempfile;

/*
 * 无成本获取环境变量和参数
 */

class Tasklist extends \app\ac\esb\Base
{

    public $type = 'E';
    public $ads = 'class';
    public $key = 'key';

    public function __construct()
    {
        //注册所有的ads

    }


    public function getAll()
    {
        $res = [
            'Level' => 1800,
            'Depend' => 1800,
            'Tasklist' => 1800,
        ];
        return $res;
    }




    public function getTasklist($type='')
    {
        $where = "type = '$type'";
        $list = model('tasklist')->where($where)->order('sort','asc')->order('id','desc')->select();
        return $list;
    }



    public function getLevel()
    {
        return 1;
    }

    public function getDepend()
    {
        return [];
    }

}
