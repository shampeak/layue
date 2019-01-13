<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;


class Campaigndt extends Base
{

    /*
     *
        $user = md('Campaigndt')->find(33801);
        $ug = $user->cam;
        $ug = $user->cam->zxm;
        $ug = $user->cam->zh;
        $ug = $user->cam->user;
        $ug = $user->cam->xm;

     */
    protected $table = 'r_campaigndt';
    protected $pk = 'id';

    /*一对一
    */
    public function cam()
    {
        return $this->hasOne('Semcam','cId','cId');
    }



}

