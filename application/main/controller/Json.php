<?php
namespace app\main\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Json extends Base
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login(request $request)
    {

        $par = $request->get();
        if($par['username'] == 111 && $par['password'] == 111){
            return [
                'code' => 0,
                'msg' => '登陆成功',
                'data' => [
                    'access_token' => ''
                ]
            ];
        }else{
            return [
                'code' => -100,
                'msg' => '登陆失败',
                'data' => [
                    'access_token' => ''
                ]
            ];
        }
    }

    public function logout()
    {
        return [
            'code' => 0,
            'msg' => '退出成功',
            'data' => ''
        ];
    }

    public function upload(request $request)
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');

        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            return [
                'status'  => 0,
                'url'   => '/uploads/'.$info->getSaveName(),
                'msg'   => '修改完成',
            ];
        }
    }

}