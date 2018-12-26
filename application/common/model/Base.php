<?php

namespace app\common\model;

use \think\Model;

class Base extends Model
{
    protected $autoWriteTimestamp = true;

    /**
     * 新增
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function add($data)
    {
        if (!is_array($data)) {
            exception('传递参数不合法');
        }
        $this->allowField(true)->save($data);
        return $this->id;
    }

}