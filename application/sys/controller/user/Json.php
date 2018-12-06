<?php
namespace app\sys\controller\user;

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

    public function groupdelete(request $request)
    {
        $id = $request->param('id');
        md('group')->where('groupID',$id)->delete();
        md('groupads')->where('groupId',$id)->delete();
        return [
            'code'=>0,
            'msg'=>'完成',
        ];
    }

    public function groupedit(request $request)
    {
        $post = $request->post();

        $res['dis'] = $post['dis'];
        $gid = $post['groupId'];
        md('group')->where('groupId',$gid)->update($res);

        $mf = [];
        if(isset($post['f'])){
            foreach($post['f'] as $key=>$value){
                $mf[] = $key;
            }
        }

        $rc['adsIds'] = json_encode($mf);
        md('groupads')->where('groupId',$gid)->update($rc);

        return [
            'code'=>0,
            'msg'=>'完成',
        ];
    }

    public function groupaddnew(request $request)
    {
        $post = $request->post();
        if( empty($post['title'])){
            return [
                'code'=>100,
                'msg'=>'组名必须填写',
            ];
        }

        //名称检查
        $row = md('group')->where('title',$post['title'])->find();
        if($row){
            return [
                'code'=>100,
                'msg'=>'组名不能重复',
            ];
        }

        $res['title'] = $post['title'];
        $res['dis'] = $post['dis'];
        md('group')->insert($res);


        $mf = [];
        if(isset($post['f'])){
            foreach($post['f'] as $key=>$value){
                $mf[] = $key;
            }
        }

        $rc['groupId'] = md('group')->getLastInsID();
        $rc['adsIds'] = json_encode($mf);
        md('groupads')->insert($rc);

        return [
            'code'=>0,
            'msg'=>'完成',
        ];
    }

    public function userlist(request $request)
    {
        $page = $request->get('page');
        $limit = $request->get('limit');

        $get    = $request->get();
        $name   = $request->get('name');
        $email  = $request->get('email');
        $sex    = $request->get('sex');
        $groupId    = $request->get('groupId');


        $where[] = "sys_user.uId= sys_usergroup.uId";
        if(!empty($name))$where[] = "sys_user.name like '%$name%'";
        if(!empty($email))$where[] = "sys_user.email like '%$email%'";
        if($sex != 99 && !empty($sex))$where[] = "sys_user.sex = '$sex'";
        if(!empty($groupId))$where[] = "sys_usergroup.groupId = '$groupId'";

        $_where = implode(' and ',$where);
        $pageb = ($page-1)*$limit;

        $sql  = "select * from sys_user,sys_usergroup where $_where limit $pageb,$limit";
        $list = Db::query($sql);
        $sql = "select count(*) as mc from sys_user,sys_usergroup where $_where";
        $rrr = Db::query($sql);

        $count = $rrr[0]['mc'];
//        $count


        $map = md('group')->getMap();

        foreach($list as $key=>$value){
            //时间
            $list[$key]['jointime'] = date('Y-m-d H:i:s',$list[$key]['jointime']);
            //用户组
            $list[$key]['groupName'] = isset($map[$list[$key]['groupId']])?$map[$list[$key]['groupId']]:'';
        }

        return [
            'code'=>0,
            'msg'=>'完成',
            "count"=>$count,
            'data'=>$list
        ];
    }

    public function userdelete(request $request)
    {
        $id = $request->param('id');
        $myid = ac('my')->getUserId();
        if($id == $myid){
            return [
                'code'=>100,
                'msg'=>'不能删除自己',
            ];
        }

        md('user')->where('uId',$id)->delete();
        //相关
        md('usergroup')->where('uId',$id)->delete();

        return [
            'code'=>0,
            'msg'=>'完成',
        ];
    }

    public function useredit(request $request)
    {
        $post = $request->post();
        if(empty($post['password'])){
            unset($post['password']);
        }else{
            $post['password'] = ac('password')->getHash($post['password']);
        }

        $uid = $post['uId'];
        md('user')->where('uId',$uid)->update($post);
        return [
            'code'=>0,
            'msg'=>'完成',
        ];

    }

    public function useraddnew(request $request)
    {
        $post = $request->post();

        if(empty($post['groupId'])){
            return [
                'code'=>100,
                'msg'=>'请选择用户组',
            ];
        }

        $rc['groupId'] = $post['groupId'];
        unset($post['groupId']);

        $post['jointime'] = time();
        //检查 用户名
        $row = md('user')->where('name',$post['name'])->find();

        if($row){
            return [
                'code'=>100,
                'msg'=>'这个用户名已经存在',
            ];
        }

        $post['password'] = ac('password')->getHash($post['password']);
        md('user')->insert($post);
        $rc['uId'] = md('user')->getLastInsID();


        md('usergroup')->insert($rc);



        return [
            'code'=>0,
            'msg'=>'完成',
        ];
    }


}
