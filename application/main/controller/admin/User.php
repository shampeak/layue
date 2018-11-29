<?php

namespace app\main\controller\admin;

use app\main\controller\Base;


/**
 * 超管后台管理员控制器
 * Class User
 * @package app\store\controller
 */
class User extends Base
{
    /**
     * 更新当前管理员信息
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
    }

    public function renew()
    {
        md('test')->run();
//        http://ue.so/main/admin.user/renew
//        $model = AdminUserModel::detail($this->admin['user']['admin_user_id']);
//        if ($this->request->isAjax()) {
//            if ($model->renew($this->postData('user'))) {
//                return $this->renderSuccess('更新成功');
//            }
//            return $this->renderError($model->getError() ?: '更新失败');
//        }
        return view('', []);

    }
}
