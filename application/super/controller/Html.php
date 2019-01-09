<?php
namespace app\super\controller;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Html extends Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(request $request)
    {
        return view('',[]);
    }

    /*
     * 单页设置页面
     */
    public function singlepage(request $request)
    {
        return view('',[]);
    }

    /*
     * 单页示例
     */
    public function listpage(request $request)
    {
        return view('',[]);
    }

    /*
     * 列表不分页
     */
    public function listpageno(request $request)
    {
        return view('',[]);
    }

    /*
     * edit示例
     */
    public function edit(request $request)
    {
        return view('',[]);
    }

    /*
      * addnew示例
      */
    public function addnew(request $request)
    {
        return view('',[]);
    }





    public function runHtml(request $request)
    {
        $html = $request->post('html');
        $html = str_replace('layequalsign','=',$html);
        $html = str_replace('layscrlayipttag','script',$html);
        echo $html;
    }

}
