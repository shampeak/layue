<?php
namespace app\sem\controller\sys;

use think\Controller;
use think\Model;
use think\Request;
use think\Db;
use think\Loader;

class Log extends \app\sys\controller\Base{

    public function __construct()
    {
        parent::__construct();
    }

    public function show(request $request)
    {
        $id = $request->get('id');
        $row = md('cgilog')->find($id);
        $note = $row['note'];
        $nr = json_decode($note);
        echo '<pre>';
        print_r($nr);
        echo '</pre>';
    }

    public function index(request $request)
    {

        return view('',[]);
    }

}
