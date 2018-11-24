<?php
namespace app\main\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Index extends Controller{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {
//        //================================================
//        //动作判断拦截
//        if($request->isPost()){
//            $action = $request->action().'Post';
//            return $this->$action($request);
//        }
//        //================================================
//
//        $post = trims($request->post());
//        $validate   = Loader::validate('Indextest');


        return view('index/index',[]);
    }




    public function info(){

        return view('index/info',[]);
    }

    public function password(){

        return view('index/password',[]);
    }

    public function avatar(){
        echo 'avatar';
    }

    public function welcome(){
        $list = [

'设置             ' => '/wsite/set',
'---设置          ' => '/wsite/set/indexPost',

'登录页'=>'/login',
'页面管理'=>'/wsite/page',
'分类管理'=>'/wsite/cat',
'文章管理'=>'/wsite/ar',
'碎片管理'=>'/wsite/sp',


        ];


        return view('index/welcome',[
            'list'=>$list
        ]);

    }

    /*
     * readme
     */
    public function document(request $request)
    {

        $file = ROOT_PATH.'Document'.DS.'Menu.md';
        $menu = file_get_contents($file);

        $filename = ucfirst($request->get('md'));
        $filename = $filename?:'Readme.md';
        $file = ROOT_PATH.'Document'.DS.$filename;
        $text = file_get_contents($file);
        $par = new \Parsedown();
        $text = $par->text($text);

        return view('../../common/tempfile/readme',[
            'menu'      => $menu,
            'text'      => $text
        ]);
    }



}
