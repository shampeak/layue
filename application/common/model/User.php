<?php
/**
 * Created by PhpStorm.
 * User: shampeak
 * Date: 2018/7/4
 * Time: 16:21
 */
namespace app\common\model;

class User extends Base
{

    protected $pk = 'uId';
    protected $table = 'sys_user';
    protected $readonly = ['name'];     //只读字段

//    public function getSexTextAttr($value,$data)
//    {
//        $status = [0=>'女',0=>'男'];
//        return $status[$data['sex']];
//    }



//    public function getUserInfo()
//    {
//        $user = UserModel::get(1);
//
//        // 输出Profile关联模型的email属性
//        echo $user->profile->email;
//
//        //如果要根据关联表的查询条件查询当前模型的数据，可以使用hasWhere方法，例如：
//        $user = User::hasWhere('profile',['email'=>'thinkphp@qq.com'])->find();
//        echo $user->name;
//        //查询多条数据 User::hasWhere('profile',['email'=>'thinkphp@qq.com'])->select();
//
//    }

//    //如果是关联查询多个用户信息，则关联查询时采用预载入查询（避免关联时多次查询）
//    $list = User::with('profile')->select([1,2,3]);
//    foreach($list as $user){
//        // 获取用户关联的profile模型数据
//        dump($user->profile); //这里注意，如果表模型名是驼峰的如userPro,则这里要用下划线$user->user_pro，要不然还是重复查询操作
//        //输出关联的字段：echo $user['profile']['email'];
//    }

//如果想直接添加关联字段到主模型，可以用绑定属性到父模型
//return $this->hasOne('Profile','user_id')->setEagerlyType(0)->bind('phone,email,address');
//输出关联字段时就可以直接用 echo $user['email'];
//如：
//$user = UserModel::get(1,'profile'); echo $user['email'];
//$users = UserModel::with('profile')->select[1,2,3];
//foreach($users as $user){
//  echo $user['email'];
//}

//如果要指定属性查询，可以使用：(也可以在关联模型定义时规定关联查询的字段)
//$list = User::field('id,name')->with(['profile'=>function($query){$query->field('email,phone');}])->select([1,2,3]);
//foreach($list as $user){
//    // 获取用户关联的profile模型数据
//    dump($user->profile);
//}

//V5.0.4+版本开始，一对一关联预载入支持两种方式：JOIN方式（一次查询）和IN方式（两次查询），用JOIN方式查询性能会好一些
//// 设置预载入查询方式为IN方式（默认） return $this->hasOne('Profile')->setEagerlyType(1);
//// 设置预载入查询方式为JOIN方式 return $this->hasOne('Profile')->setEagerlyType(0);
//如上面在User模型中定义的一对一关联可以改为：
//public function profile()
//{
//    return $this->hasOne('Profile','user_id')->setEagerlyType(0)->bind('phone,email,address');
//}

//    public function saveUserProfile()
//    {
//        $user = User::get(1);
//// 如果还没有关联数据 则进行新增
//        if(isset($user->profile->email)){ //如果存在关联属性，则为更新
//            $user->profile->save(['email'=>'thinkphp']);
//        }else{
//            $user->profile()->save(['email' => 'thinkphp']); //此处若没有判断会一直新增
//        }
//    }
//
////关联自动写入：together();
//    public function saveUser()
//    {
//        $userInfo = UserModel::get(1);
//        if(!$userInfo){ //关联新增
//            $user = new UserModel(); //实例化User模型并给属性赋值
//            $user->loginname = 'piter';
//            $user->create_time = time();
//            $profile = new ProfileModel();//实例化Profile模型并给属性赋值
//            $profile->email = '123@my.com';
//            $profile->phone = '13245678901';
//            $user->profile = $profile;//指定关联模型
//            $user->together('profile')->save(); //关联写入
//        }else{ //关联更新
//            $userInfo->last_login_time = time();
//            $userInfo->profile->email = '345@my.com';
//            $userInfo->together('profile')->save();
//        }
//    }
//
////关联删除
//    public function deleteUser()
//    {
//        $userInfo = UserModel::get(1);
//        $userInfo->together('profile')->delete();
//    }


}

