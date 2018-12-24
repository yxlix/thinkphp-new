<?php
/**
 * Created by PhpStorm.
 * User: L
 * Date: 2018/12/25
 * Time: 0:17
 */

namespace app\common\lib;

//引入鉴权类
use Qiniu\Auth;
//引入上传类
use Qiniu\Storage\UploadManager;

class Upload
{
    /**
     * 七牛图片上传基础封装
     * @return null|string
     * @throws \Exception
     */
    public static function image()
    {
        if (empty($_FILES['file']['tmp_name'])) {
            exception('您提交的图片数据不合法', 404);
        }
        // 初始化签权对象
        $config = config('qiniu');
        $auth = new Auth($config['accessKey'], $config['secretKey']);
        $bucket = $config['bucket'];

        // 生成上传Token
        $token = $auth->uploadToken($bucket);

        // 要上传文件的本地路径
        $filePath = $_FILES['file']['tmp_name'];

        $pathinfo = pathinfo($_FILES['file']['name'])['extension'];


        // 上传到七牛后保存的文件名
        $key = date('Y'). '/' . date('m') . '/' . substr(md5($filePath),0,5).date('YmdHis') . rand(0,9999) . '.' . $pathinfo;

        // 构建 UploadManager 对象
        $uploadMgr = new UploadManager();
        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {
           return null;
        } else {
            return $key;
        }
    }
}