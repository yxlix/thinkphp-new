<?php
namespace app\common\model;
use \think\Model;
class AdminUser extends Model{
    /*
     *
     */
  public function add($data){
      if (is_array($data)){
        $this->createTime();
      }
  }

}