<?php

namespace app\admin\controller;

use think\Controller;

/**
 * 后台基础类库
 * Class Base
 * @package app\admin\controller
 */
class Base extends Controller
{
    public function _initialize()
    {
//       判断用户是否登录
        $isLogin = $this->isLogin();
//        未登录，跳转到登录页面
        if (!$isLogin) {
            return $this->redirect('login/index');
        }
    }

    /**
     * 判断是否登录
     * @return bool
     */
    public function isLogin()
    {
        $user = session(config('admin.session_user', '', config('admin.session_user_scope')));
        if ($user && $user['adminuser']->id) {
            return true;
        }

        return false;
    }
}
