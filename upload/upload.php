<?php
/*
*文件上传
*后台处理程序
*/


//接收提交页面传送的相关信息
$name = $_POST['username'];
$intro = $_POST['fileintro'];
//$_FILES中存放着文件的相关信息
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";

//可以在这里对文件大小进行限制
/*$filesize = $_FILES['myfile']['size'];
if($filesize>2*1024*1024){
    echo "文件过大，不能上传";
    exit();
}*/
 
 //可以对文件类型进行限制
 /*$filetype = $_FILES['myfile']['type'];
 if($filetype!='image/jpg'&&$filetype!='application/pdf'){
     echo "文件类型只能是jpg和pdf";
     exit();
 }*/
 
if (is_uploaded_file($_FILES['myfile']['tmp_name'])) {
    //把文件转存到你希望存放的目录
    $uploaded = $_FILES['myfile']['tmp_name'];
    
    //每个用户动态创建一个文件夹
    $userpath = $_SERVER['DOCUMENT_ROOT']."/upload/".$name;
    //判断该用户是否已经有文件夹
    if(!file_exists($userpath)){
        mkdir($userpath);
    }
    
    //防止同一用户上传同名文件，可在文件中添加时间戳。
    //$moveto   = $userpath."/".time().$_FILES['myfile']['name'];
    
    //或者对文件名进行修改，但是需要使用字符串处理截得文件后缀名
    $truename = $_FILES['myfile']['name'];
    $moveto   = $userpath."/".time().substr($truename,strrpos($truename,"."));
    
    if(move_uploaded_file($uploaded,iconv("utf-8", "gb2312", $moveto))){
        echo "上传文件".$_FILES['myfile']['name']."成功";
    }else{
        echo "上传文件".$_FILES['myfile']['name']."失败";
    }
}else{
    echo "上传文件".$FILES['myfile']['name']."失败";
}

if (($filetype=="image/gif")||($filetype=="image/pjpeg"))
{
    //如果是图形文件格式则显之
    echo "<p><img src='";
    echo $moveto;
    echo "'height=150 width=150 align=center border=0>";
}

?>
