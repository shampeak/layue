<?php

function upload(){
    $extensions = array("jpg","bmp","gif","png");
    $uploadFilename = $_FILES['upload']['name'];
    $extension = pathInfo($uploadFilename,PATHINFO_EXTENSION);
    if(in_array($extension,$extensions)){
        $uploadPath = str_replace("\\",'/',realpath(__ROOT__))."/uploads/";
        $uuid = str_replace('.','',uniqid("",TRUE)).".".$extension;
        $desname = $uploadPath.$uuid;
        $previewname = '/uploads/'.$uuid;
        $tag = move_uploaded_file($_FILES['upload']['tmp_name'],$desname);
        $callback = $_REQUEST["CKEditorFuncNum"];
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($callback,'".$previewname."','');</script>";
    }else{
        echo "<font color=\"red\"size=\"2\">*文件格式不正确（必须为.jpg/.gif/.bmp/.png文件）</font>";
    }
}



//$cb = $_GET['CKEditorFuncNum']; //获得ck的回调id
//try {
//    if(isset($_FILES['upload'])) { //上传的图片的信息存在$_FILES['upload']
//        $s = new FileService();
//        $url = $s->uploadImg($_FILES[$name], $folder); //我自己的放置上传图片的逻辑，返回图片放置后的url
//        echo "<script>window.parent.CKEDITOR.tools.callFunction($cb, '$url', '');</script>" //图片上传成功，通知ck图片的url
//	}
//}catch (\Exception $e) {
//    $erro = $e->getMessage();
//    echo "<script>window.parent.CKEDITOR.tools.callFunction($cb, '', '$error');</script>" //图片上传失败，通知ck失败消息
//}