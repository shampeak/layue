<?php
namespace app\site\controller;

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


    public function fragaddnew(request $request)
    {
        $res = $request->post();

        //字符不能重复    todo
        $chr = $res['chr'];

        md('frag')->insert($res);

        return [
            'code'=>0,
            'msg'=>'添加完成',
        ];
    }


    public function fragedit(request $request)
    {
        $post = $request->post();

        md('frag')->where('id',$post['id'])->update($post);

        return [
            'code'=>0,
            'msg'=>'操作完成',
        ];
    }

    public function fragdelete(request $request)
    {
        $id = $request->param('id');
        md('frag')->where('id',$id)->delete();

        return [
            'code'=>0,
            'msg'=>'操作完成',
        ];
    }

    public function fraglist(request $request)
    {
        $list = md('frag')->select();

        return [
            'code'=>0,
            'msg'=>'修改完成',
            'data'=>$list
        ];
    }













    public function channeladdnew(request $request)
    {
        $res = $request->post();
        $post['hidden'] = isset($post['hidden'])?intval($post['hidden']):0;

        //字符不能重复    todo
        $chr = $res['chr'];

        md('channel')->insert($res);
        return [
            'code'=>0,
            'msg'=>'添加完成',
        ];
    }


    public function channeledit(request $request)
    {
        $post = $request->post();
        $post['hidden'] = isset($post['hidden'])?intval($post['hidden']):0;

        md('channel')->where('channelId',$post['channelId'])->update($post);

        return [
            'code'=>0,
            'msg'=>'操作完成',
        ];
    }

    public function channeldelete(request $request)
    {
        $id = $request->param('id');
        md('channel')->where('channelId',$id)->delete();
        return [
            'code'=>0,
            'msg'=>'操作完成',
        ];
    }

    public function channellist(request $request)
    {
        $list = md('channel')->select();

        return [
            'code'=>0,
            'msg'=>'修改完成',
            'data'=>$list
        ];
    }
    /*
     * 站点设置
     */
    public function setup(request $request)
    {
        $post = $request->post();
        $f = $post['F'];

        foreach($f as $key=>$value){
            $rc['value'] = $value;
            md('config')->where('name',$key)->update($rc);
        }

        return [
            'code'=>0,
            'msg'=>'修改完成'
        ];
    }

    /*
     * 上传文件
     */
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