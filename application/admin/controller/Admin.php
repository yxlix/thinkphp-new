<?php
namespace app\admin\controller;
use think\Controller;
class Admin extends Controller
{
    public function add()
    {
        if(request()->isPost()){
            //dump(input('post.'));
            $data = input('post.');
            $Validate = validate('AdminUser');
            if(!$Validate->check($data)){
                $this->error($Validate->getError());
            }
        }else{
            return $this->fetch();
        }
        
    }
    
}
