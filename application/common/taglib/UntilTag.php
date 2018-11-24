<?php
/*
 * 这个作为示例
 * 规划标签
 * ================================================
 * 1 ：全局标签
 * 2 ：后台标签
 * 3 ：前台标签
 * ================================================
 * 注意点，
 * 分类
 * 命名
 * 使用习惯
 */
namespace app\common\taglib;
use \think\template\TagLib;

class UntilTag extends TagLib
{
    protected $tags = [
        'breadcrumb000' => [
            'attr' => 'name',
            'close' =>0
        ],
        'testclose' => [ 'attr' => 'name,content',  'close' =>0 ],
        'testopen'  => [ 'attr' => 'name'],     //默认为对称标签
        'testblank'  => [  'close' =>0 ],     //默认为对称标签
//        'arclist'=>[ 'attr'=>'row,orderby,flag,typeid'],
    ];




    /**
    * 用法
    * {breadcrumb000 name='个人中心/修改密码' /}
    * @param $tag
     * @param $content
    * @return string
    * @autor:
    */
    public function tagBreadcrumb000($tag, $content)
    {
        $tags = '';
        if(isset($tag['name']) && !empty($tag['name']))
        {
            $tags = explode('/',$tag['name']);
        }
        $parseStr = '<nav class="breadcrumb"><i class="Hui-iconfont"></i> <a class="maincolor" href="">首页</a>' ;

        if(!empty($tags))
        {
            foreach($tags as $vo)
            {
                $parseStr .= "<span class='c-666 en'>></span><span class='c-666'>{$vo}</span>";
            }
        }
        $parseStr .= '</nav>';

        return $parseStr;
    }

    /*
    {textopen name="123" }voote{/textopen}
     */
    public function tagTestopen($tag,$content){
        $parseStr='';
        $parseStr.="<h1>{$tag['name']}</h1>";
        $parseStr.="<br/>content:{$content}";
        return $parseStr;
    }


    /*
    {testclose name="123" content="cococo" }
     */
    public function tagTestclose($tag, $content)
    {
        $parseStr ="<h1>{$tag['name']}---{$tag['content']}</h1>";
        return $parseStr;
    }

    /*
     * {testblank}
     */
    public function tagTestblank($tag, $content)
    {
        $parseStr ="mark";
        return $parseStr;
    }


//    /**     * arclist自定义标签     */
//    public function _arclist($tag,$content){
//        $limit  =    $tag['row'];
//        $order  =    $tag['orderby'];
//        if(isset($tag['typeid'])){
//            $arr['cid'] = $tag['typeid'];
//        }
//        $list = M("article")->limit($limit)->order($order)->where($arr)->select();
//        $str='';
//        for($i=0;$i<count($list);$i++){
//            $str .= str_replace(array("[filed:id]","[filed:title]"),array($list[$i]['id'],$list[$i]['title']),$content);
//        }
//        return $str;
//    }


/*
{breadcrumb name='个人中心/修改密码'}
    {testopen name='1234'}co 2{/testopen}
{testclose name="123" content="cococo" }
{testblank}
*/

/*
 * //================================================
 * 前端示例
    {breadcrumb name='个人中心/修改密码'}
        {testopen name='1234'}co 2{/testopen}
    {testclose name="123" content="cococo" }
 * //================================================
 */


}
 