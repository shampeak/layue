<?php
namespace app\sys\controller\my;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Json extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {
    }


    public function myinfo(request $request)
    {
        $post = $request->post();
        $myid = ac('my')->getUserId();

        $res = md('user')->where('uId',$myid)->update($post);
        return [
            'code'=>0,
            'msg'=>'修改完成'
        ];

    }

    /*
     * 更改我的密码
     */
    public function password(request $request)
    {
        $oldpassword = $request->get('oldPassword');
        $password = $request->get('password');
        $repassword = $request->get('repassword');

        if($password != $repassword){
            return [
                'code'=>100,
                'msg'=>'两次密码输入不一样'
            ];
        }

        //密码校验
        $myid = ac('my')->getUserId();
        $row = md('user')->find($myid);
        $res  =ac('password')->verify($oldpassword,$row['password']);
        if(!$res){
            return [
                'code'=>100,
                'msg'=>'原密码验证没有通过'
            ];
        }

        //更改
        $rc['password'] = ac('password')->getHash($password);
        md('user')->where('uId',$myid)->update($rc);

        return [
            'code'=>0,
            'msg'=>'完成'
        ];
    }



}
