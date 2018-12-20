<?php

namespace app\admin\controller;

use think\Controller;

class Admin extends Controller
{
    public function add()
    {
        if (request()->isPost()) {
            //dump(input('post.'));
            $data = input('post.');
            $Validate = validate('AdminUser');
            if (!$Validate->check($data)) {
                $this->error($Validate->getError());
            }
            $data['password'] = md5($data['password']);
            $data['status'] = 1;
            try {
                $id = model('AdminUser')->add($data);
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            if ($id) {
                $this->success('id=' . $id . '的用户添加成功');
            } else {
                $this->error('error');
            }
        } else {
            return $this->fetch();
        }

    }

}
