/**
 * 通用 from 表单中提交数据的方法
 * @param form
 */
function app_save (form) {
    var data = $(form).serialize();
    // console.log(data);

    url = $(form).attr('url');
    $.post(url,data,function (result) {
        if (result.code == 0) {
            layer.msg(result.msg,{icon:5,time:2000});
        }else if(result.code == 1){
            self.location = result.data.jump_url;
        }
    },'JSON');
}