<?php
namespace app\main\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Base extends Controller{

    public function __construct()
    {
        parent::__construct();
        //role
        $check = esb('role')['check'];
        if(!$check){
            echo '权限错误';
            die();
        }
        ac('ini')->register();
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
