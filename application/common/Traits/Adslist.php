<?php
namespace app\common\Traits;

trait Adslist {

    /*
     * readme
     */
    public function adslist()
    {
        //================================================
        //动作判断
//        if($request->isPost()){
//            $action = $request->action().'Post';
//            return $this->$action($request);
//        }
        //================================================

        //==================================================
        //
        //==================================================
        $request = \Think\Request::instance();
        $a = $request->module();
        $_list = md('ads')->where('a',$a)->where('id < 420')->select();
        foreach($_list as $key=>$value){
            $_list[$key] = $value->toArray();
            if($value['pId']==0){
                $list[] = $value->toArray();
            }
        }
        //==================================================
        //
        //==================================================
        foreach($list as $key=>$value){
            $list[$key] = findchild($value,$_list);
            foreach($list[$key]['child'] as $key2=>$value2){
                $list[$key]['child'][$key2] = findchild($value2,$_list);
                foreach($list[$key]['child'][$key2]['child'] as $key3=>$value3){
                    $list[$key]['child'][$key2]['child'][$key3] = findchild($value3,$_list);
                    foreach($list[$key]['child'][$key2]['child'][$key3]['child'] as $key4=>$value4) {
                        $list[$key]['child'][$key2]['child'][$key3]['child'][$key4] = findchild($value4,$_list);
                        foreach($list[$key]['child'][$key2]['child'][$key3]['child'][$key4]['child'] as $key5=>$value5) {
                            $list[$key]['child'][$key2]['child'][$key3]['child'][$key4]['child'][$key5] = findchild($value5,$_list);
                        }
                    }
                }
            }
        }


        return view('../../common/tempfile/adslist',[
            'list'=>$list
        ]);
    }


}
