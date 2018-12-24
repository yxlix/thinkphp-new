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

    public function index(){

        return $this->fetch('',[
            'cats' => config('cat.lists')
        ]);
    }
public function add(){

    return $this->fetch('',[
        'cats' => config('cat.lists')
    ]);
}
}