<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;

class Article extends Base
{
    protected $pk = 'id';
    protected $table = 'site_article';

    public function content()
    {
        return $this->hasOne('Articlecontent','article_id')->field('note');
    }

    public function getCreateAtAttr($value)
    {
        return date('Y-m-d H:i:s',$value);
    }

//    public function profile()
//    {
//        return $this->hasOne('Profile')->field('id,name,email');
//    }

    /*
     * 关联的文章分类属性
     */
    public function cat()
    {
        return $this->hasOne('Category','cId')->field('title');
    }




//    public function profile2()
//    {
//        return $this->hasOne('Profile','user_id');
////两个参数分别是Profile模型名（需要新建Profile.php），外键名（也就是在profile表中关联user表的字段名）
////可以支持为关联模型定义需要查询的字段,return $this->hasOne('Profile','user_id')->field('phone,email,address');
//    }


    /*
     $res = md('article')->find(1);
     print_r($res->profile['content']);
     */



}

/*

$user = User::get(1);
// 如果还没有关联数据 则进行新增
$user->profile()->save(['email' => 'thinkphp']);

$user = User::get(1);
$user->profile->email = 'thinkphp';
$user->profile->save();
// 或者
$user->profile->save(['email' => 'thinkphp']);

$profile = Profile::get(1);
// 输出User关联模型的属性
echo $profile->user->account;


/*
写入
    $blog = new Blog;
    $blog->name = 'thinkphp';
    $blog->title = 'ThinkPHP5关联实例';
    $content = new Content;
    $content->data = '实例内容';
    $blog->content = $content;
    $blog->together('content')->save();

更新
// 查询
    $blog = Blog::get(1);
    $blog->title = '更改标题';
    $blog->content->data = '更新内容';
// 更新当前模型及关联模型
    $blog->together('content')->save();

删除
// 查询
    $blog = Blog::get(1);
// 删除当前及关联模型
    $blog->together('content')->delete();
*/

