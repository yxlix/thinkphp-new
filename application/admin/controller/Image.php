<?php
/**
 * Created by PhpStorm.
 * User: xx
 * Date: 2018/12/20
 * Time: 10:55
 */

namespace app\admin\controller;
use app\common\lib\Upload;

class Image extends Base
{
    public function upload0(){
        $data = [
            'status' => 1,
            'message' => 'ok',
            'data' => 'http://img5.imgtn.bdimg.com/it/u=558292665,1709861858&fm=26&gp=0.jpg'
        ];
        return json_encode($data);
    }

    public function upload(){
        $image = Upload::image();
        if ($image){
            $data = [
                'status' => 1,
                'message' => 'ok',
                'data' => config('qiniu.image_url') . '/' . $image
            ];
            return json_encode($data);
        }

        return json_encode(['status' => 0 ,'message' => '上传失败']);
    }
}