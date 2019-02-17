<?php
namespace app\sys\controller\platform;

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

    use \app\common\Traits\Gethtml;

    public function setup(request $request)
    {

        $res = md('config')->where('group',5)->order('sort','desc')->select();
        foreach($res as $key=>$value){
            $res[$key]['html'] = $this->gethtml($value);
        }

        //==============================================
        return view('',[
            'res'=>$res
        ]);
    }


}
