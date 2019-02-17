<?php
namespace app\api\controller\sem;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Zh extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function zhfrommedaitype(request $request)
    {
        $mediatype = $request->get('medaitype');

        $list = md('semzh')->where('mediatype',$mediatype)->select();

        return [
            'code'=>0,
            'data'=>$list
        ];
    }



    public function enable(request $request)
    {
        $id = $request->post('id');
        $enable = $request->post('enable');
        $rc['enable'] = $enable?0:1;
        md('semzh')->where('id',$id)->update($rc);
        return [
            'code'=>0,
            'msg'=>$enable
        ];
    }

    public function editfd(request $request)
    {
        $post = $request->post();
        $id = $request->post('id');

        if($post['rate']>=1 || $post['rebatexx']>=1){
            return [
                'code'=>10,
                'msg'=>'数值错误'
            ];
        }

        md('semzh')->where('id',$id)->update($post);

        return [
            'code'=>0,
        ];
    }


    public function edit(request $request)
    {
        $enc        = ac('Enc');

        $post = $request->post();
        $id = $request->post('id');

        if(empty($post['pwd'])){
            unset($post['pwd']);
        }else{
            $post['pwd']    = $enc->encrypt($post['pwd']);
        }
        if(empty($post['hash'])){
            unset($post['hash']);
        }else{
            $post['hash']   = $enc->encrypt($post['hash']);
        }

        md('semzh')->where('id',$id)->update($post);

        return [
            'code'=>0,
        ];
    }

    public function addnew(request $request)
    {
        $enc        = ac('Enc');
        $post = $request->post();

        $post['pwd']    = $enc->encrypt($post['pwd']);
        $post['hash']   = $enc->encrypt($post['hash']);

        md('semzh')->insert($post);

        return [
            'code'=>0,
        ];
    }

    public function delete(request $request)
    {
        $id = $request->get('id');
        md('semzh')->where('id',$id)->delete();

        return [
            'code'=>0,
        ];

    }

    public function dlist(request $request)
    {
//        $get = $request->get();
//        print_r($get);


        $page = $request->get('page');
        $limit = $request->get('limit');

        $key = $request->get('key');
        $mediatype = $request->get('mediatype');
        $connect = $request->get('connect');
        $type = $request->get('type');
        $enable = $request->get('enable');


        $_where[] = "1=1";

        if($enable == '0') {
            $_where[] = "enable = 0";
        }elseif($enable == '1'){
            $_where[] = "enable = 1";
        }

        if($type =='0'){
            $_where[] = "type = 0";
        }elseif($type=='1'){
            $_where[] = "type = 1";
        }

        if($key){
            $_where[] = "uname like '%$key%'";
        }
        if($mediatype){
            $_where[] = "mediatype = $mediatype";
        }

        if($connect =='1'){
            $_where[] = "connectcheck = 1 and enable = 1";
        }elseif($connect =='0'){
            $_where[] = "(connectcheck = 0 or enable = 0)";
//                echo "(connectcheck = 0 or enable = 0)";
        }

        $where = implode(' and ',$_where);

        $list = md('semzh')->where($where)->limit($limit*($page-1),$limit)->select();
        $count = md('semzh')->where($where)->limit($limit*($page-1),$limit)->count();
        $mediatype = getConfig('MEDIA_TYPE');

        //媒体的翻译
        foreach($list as $key=>$value){
            $list[$key]['media'] = $mediatype[$value['mediatype']];
            $list[$key]['lastApitime'] = date('m-d H:i',$value['lastApitime']);

        }

        return [
            'code'=>0,
            'count'=>$count,
            'msg'=>'成功',
            'data'=>$list
       ];
    }


}
