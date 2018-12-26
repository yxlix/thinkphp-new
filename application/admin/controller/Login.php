<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 2018/12/18
 * Time: 10:40
 */

namespace app\admin\controller;


use think\Controller;

class Login extends Base
{
    public function _initialize()
    {
    }

    public function index(){
        $isLogin = $this->isLogin();
        if ($isLogin){
            return $this->redirect('index/index');
        }
        return $this->fetch();
    }

    public function check(){
        if(!request()->isPost()){
            $this->error('请求参数不合法');
        }

        $data = input('post.');



        if (!captcha_check($data['verifyCode'])){
            $this->error('验证码不正确');
        }

        $user = model('AdminUser') ->get(['username' => $data['username']]);
        if (!$user || $user->status != config('code.status_normal')){
            $this->error('用户名不存在');
        }

        if ($user->password != md5($data['password'])){
            $this->error('密码错误');
        }

        $udata = [
            'last_login_time' => time(),
            'last_login_ip' => request()->ip(),
        ];

        try{
            model('AdminUser') ->save($udata,['id' => $user->id]);
        }catch(\Exception $e){
            $this->error($e->getMessage());
        }

        session(config('admin.session_user'),$user,config('session_user_scope'));
        $this->success('登录成功','index/index');
//        halt($user);
    }

    /**
     * 退出登录
     */
    public function logout(){
        session(null,config('session_user_scope'));
        $this->redirect('login/index');
    }
}