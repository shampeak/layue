<?php
namespace app\sem\controller\json;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class User extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function grouplead(request $request)
    {
        $post = $request->post();

        $groupuserid = isset($post['groupuserId'])?$post['groupuserId']:[];
        $pId = $post['pId'];

        md('user')->where('pId',$pId)->update([
            'pId'=>0
        ]);

        foreach($groupuserid as $key=>$value){
            md('user')->where('uId',$value)->update([
                'pId'=>$pId
            ]);
        }



        return [
            'code'=>0
        ];
    }

    /*
     * sem 组
     */
    public function leadlist(request $request)
    {

        $md = \think\Config::get('semgroup');
        $list = md('User')->where('islead',1)->where('groupId','in',$md)->select();
        return [
            'code'=>0,
            'msg'=>'成功',
            'data'=>$list
        ];
    }

}
