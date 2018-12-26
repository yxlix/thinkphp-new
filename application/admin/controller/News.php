<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/12/24
 * Time: 22:07
 */

namespace app\admin\controller;
use think\Controller;

class News extends Base
{

    public function index()
    {
        echo 'test';
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            //数据需要做校验 validate机制

            //入库操作
            try {
                $id = model('News')->add($data);
            } catch (\Exception $e) {
                return $this->result('', 0, '新增失败');
            }

            if ($id) {
                return $this->result(['jump_url' => url('news/index')], 1, 'OK');
            } else {
                return $this->result('', 0, '新增失败');
            }
        }

        return $this->fetch('', [
            'cats' => config('cat.lists')
        ]);
    }

}