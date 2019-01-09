<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;


class Config extends \think\Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'sys_config';

    /*
     $typelist = md('config')->typelist();
     print_r($typelist);
     $res = md('config')->getConfig('CONFIG_GROUP_LIST');
     print_r($res);
     $res = md('config')->getConfig('INDEX_BG_COLOR');
     print_r($res);
    */

    public function getFormAttr($value,$data)
    {
        return $this->gethtml($data);
    }

    public function grouplist()
    {
        $md = $this->getConfig('CONFIG_GROUP_LIST');
        return $md;
    }

    public function getConfig($chr)
    {
        $row = $this->where('name',$chr)->find();
        switch($row['type']){
            case '0':               //整型
                return intval($row['value']);
                break;
            case '1':
            case '2':               //值
                return $row['value'];
                break;
            case '3':               //map
                //组 返回map
                $rc = explode("\n",$row['value']);
                $_g = [];
                foreach($rc as $key=>$value){
                    if(!empty($value)){
                        $_ar = explode(":",trim($value,"\r"));
                        if(count($_ar)==2){
                            $_g[$_ar[0]] = $_ar[1];
                        }
                    }
                }
                return $_g;
                break;
            case '4':               //枚举
                //枚举 用于配置本身
                return $row['value'];
                break;
            default:
                break;
        }
        return null;
    }








    function gethtml($value = [])
    {
        if($value['type'] == 0 || $value['type'] == 1){
            return $this->gethtmlinput($value);
        }elseif($value['type'] == 2 || $value['type'] == 3){    //3 对option选项进行定义
            return $this->gethtmltextarea($value);
        }elseif($value['type'] == 4){
            return $this->gethtmloption($value);
        }else{
            return '';
        }
    }

    /**
     * @param array $value
     */
    private function gethtmlinput($value = [])
    {
$html = "<div class=\"layui-form-item\">
    <label class=\"layui-form-label\">##title##</label>
    <div class=\"layui-input-block\">
        <input type=\"text\" name=\"rc[##name##]\" placeholder=\"##title##\" value=\"##value##\" class=\"layui-input\">
    </div>
</div>";
        $html = str_replace('##title##',$value['title'],$html);
        $html = str_replace('##value##',$value['value'],$html);
        $html = str_replace('##name##',$value['name'],$html);
        $value['remark'] = $value['remark'].'<br>Name : <span class="red">'. $value['name'].'<span>';
        $html = str_replace('##remark##',$value['remark'],$html);
        return $html;
    }

    /**
     * @param array $value
     * textarea
     */
    private function gethtmltextarea($value = [])
    {

$html = "<div class=\"layui-form-item layui-form-text\">
    <label class=\"layui-form-label\">##title##</label>
    <div class=\"layui-input-block\">
        <textarea name=\"rc[##name##]\" placeholder=\"##title##\" class=\"layui-textarea\">##value##</textarea>
    </div>
</div>";

        $html = str_replace('##title##',$value['title'],$html);
        $html = str_replace('##value##',$value['value'],$html);
        $html = str_replace('##name##',$value['name'],$html);
        $value['remark'] = $value['remark'].'<br>Name : <span class="red">'. $value['name'].'<span>';
        $html = str_replace('##remark##',$value['remark'],$html);
        return $html;
    }

    /**
     * @param array $value
     * option 格式
     */
    private function gethtmloption($value = [])
    {
        $option = "<option value=\"##key##\" ##selected##>##item##</option>";
        $selecte = "selected=\"selected\"";
$html = "<div class=\"layui-form-item layui-form-text\">
    <label class=\"layui-form-label\">##title##</label>
    <div class=\"layui-input-block\">
        <select name=\"rc[##name##]\" lay-verify=\"required\" lay-filter=\"aihao\">
        ##option##
        </select>
    </div>
</div>";

        //首先根据extra
        $htmloption = '';
        $optionlist = explode("\n",$value['extra']);        //value['value'] 是选中的值
        foreach($optionlist as $key=>$v){
            $v = trim($v,"\r");
            if(!empty($v)){
                $_v = explode(":",$v);
                $v1 = $_v[0];
                $v2 = $_v[1];
                $vselect = ($value['value'] == $v1)?$selecte:'';
                $_option = str_replace('##key##',$v1,$option);
                $_option = str_replace('##item##',$v2,$_option);
                $_option = str_replace('##selected##',$vselect,$_option);
                $htmloption .= $_option;
            }
        }
        $html = str_replace('##option##',$htmloption,$html);
        $html = str_replace('##title##',$value['title'],$html);
        $html = str_replace('##value##',$value['value'],$html);
        $html = str_replace('##name##',$value['name'],$html);
        $value['remark'] = $value['remark'].'<br>Name : <span class="red">'. $value['name'].'<span>';
        $html = str_replace('##remark##',$value['remark'],$html);
        return $html;
    }

}

