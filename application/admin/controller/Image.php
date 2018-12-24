<?php

namespace app\admin\controller;

use app\common\lib\Upload;
use think\Controller;
use think\Request;

/**
 * 后台图片上传类
 * Class Index
 * @package app\admin\controller
 */
class Image extends Base
{
    public function upload()
    {
        try{
            $image = Upload::image();
        }catch (\Exception $e){
            return json_encode(['status' => 0 ,'message' => $e->getMessage()]);
        }
        if ($image){
            $data = [
                'status' => 1,
                'message' => 'OK',
                'data' => config('qiniu.image_url') . '/' . $image
            ];
            return json_encode($data);
        }
        return json_encode(['status' => 0 ,'message' => '上传失败']);
    }


}
