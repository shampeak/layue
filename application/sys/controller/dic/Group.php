<?php
namespace app\sys\controller\dic;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Group extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }


    public function addnew(request $request)
    {

        return view('',[]);
    }

    public function index(request $request)
    {

        return view('',[]);
    }

}
