<?php
namespace app\super\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Menu extends Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function editads(request $request)
    {
        $id = intval($request->get('id'));
        //没有menu的ads pid置0

        $row = md('ads')->find($id);
        return view('menu/editads',[
            'row'=>$row
        ]);
    }


    /*
     * 编辑菜单其中的功能
     */
    public function editfun(request $request)
    {
        $id = intval($request->get('id'));
        //没有menu的ads pid置0
        $sql = "update sys_ads set pId = 0 where pId not in(select Id from sys_adsindex)";
        Db::query($sql);

        $mlist = md('ads')->where('enable',1)->where('menulevel','<>',0)->select();
        foreach($mlist as $key=>$value){
            $list[$value['a']][] = $value;
        }
        return view('menu/editfun',[
            'list'=>$list,
        ]);
    }


    public function edit(request $request)
    {
        $id = intval($request->get('id'));
        $row = md('adsindex')->find($id);
        return view('menu/edit',[
            'row'=>$row
        ]);
    }


    public function addnew(request $request)
    {
        return view('menu/addnew',[]);
    }

    public function index(request $request)
    {
        $tree = [];
        $list = md('adsindex')->order('sort','desc')->select();
        foreach($list as $key=>$value) {
            $list[$key] = $value->toArray();
        }
        foreach($list as $key=>$value) {
            if ($value['pId'] == 0){
                $tree[] = $value;
            }
        }

        foreach($tree as $key=>$value) {
            $tree[$key]['child'] = [];

            foreach($list as $k=>$v){
                if($value['Id'] == $v['pId']){
                    $tree[$key]['child'][] = $v;
                }
            }
        }

        $where = "enable = 1 and menulevel <>0";
        $adslist = md('ads')->where($where)->order('sort','desc')->select();

        return view('menu/index',[
            'list'=>$list,
            'adslist'=>$adslist,
            'tree'=>$tree,
        ]);
    }




}
