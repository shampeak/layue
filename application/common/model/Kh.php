<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;

class Kh extends Base
{

    protected $pk = 'khId';
    protected $table = 'xm_kh';


    public  function getMap($title = '',$key = '')
    {
        empty($key)     && $key = $this->pk;
        empty($title)   && $title = 'name';
        //=================================================
        $map = $this->column($title,$key);

        return $map;
    }

}

