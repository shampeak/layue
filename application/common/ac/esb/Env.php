<?php
namespace app\common\ac\esb;

use think\Model;
use think\Cookie;
use think\Request;

/*
 * 无成本获取环境变量和参数
 */

class Env extends Base{

    public function __construct(){
        //注册所有的ads

    }


    public function getAll(){
        $res = [
            'Post'      => '1800',
            'Get'       => '1800',
            'Param'     =>1800,
            'Path'      => '1800',
            'Ext'       => '1800',
            'Ads'       => '1800',
            'IsPost'    => '1800',
            'IsGet'     => '1800',
            'Domain'    => '1800',
            'Ip'        => '1800',
            'Url'       => '1800',
            'LoginRoot' => 1800,
            'Method'    => '1800',
            'Dis'    => 1800,
        ];
        return $res;
    }

    public function getLoginRoot()
    {
        return '/adm/login';
    }


    public function getParam()
    {
        return Request::instance()->param();
    }


    public function getMethod()
    {
        return Request::instance()->method();;
    }

    public function getUrl()
    {
        return Request::instance()->url();
    }

    public function getIp()
    {

        return Request::instance()->ip();
    }

    public function getDomain()
    {
        $res = Request::instance()->domain();
        return $res;
    }

    public function getIsGet()
    {

        $res = Request::instance()->isGet();
        return $res;
    }
    public function getIsPost()
    {
        $res = Request::instance()->isPost();
        return $res;
    }

    public function getAds()
    {
        $request = Request::instance();
        $path = $request->path();
        $path = trim($path,'/');
        $ar = explode('/',$path);
        if(count($ar)>3){
            $ar= [$ar[0],$ar[1],$ar[2]];
        }

        switch(count($ar)){
            case 3:
                $adsful = implode('/',$ar);
                $adsful = '/'.$adsful;
                break;
            case 2:
                $adsful = implode('/',$ar);
                $adsful = '/'.$adsful.'/index';
                break;
            case 1:
                $adsful = implode('/',$ar);
                $adsful = '/'.$adsful.'/index/index';
                break;
        }
        return $adsful;
    }

    public function getPath()
    {
        return Request::instance()->path();
    }



    public function getPost(){
        return Request::instance()->post();
    }

    public function getGet(){
        return Request::instance()->get();
    }

}
/*
$esb = Esb::getInstance();
$id = $esb['my']['id'];
print_r($id);
exit;
 */