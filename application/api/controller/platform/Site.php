<?php
namespace app\api\controller\platform;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Site extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function setup(request $request)
    {

        $post =$request->post();
        $rc = $post['rc'];
        foreach($rc as $key=>$value){
            $res['value'] = $value;
            md('config')->where('name',$key)->update($res);
       }


        return [
            'code'=>0,
            'msg'=>'修改完成'
        ];


    }

}
