<?php
/*
*　文件下载
*　单文件下载
*/
    function down_file($file_name,$file_path){
    //$file_name = iconv("uft-8","gb2312",$file_name);    //如果文件名是中文，需要对中文名称转码gb2312
    //要下载的文件读取到服务器的内存中
    //服务器返回文件数据给浏览器
    //浏览器将文件写入用户指定的位置
    //1.判断文件是否存在
    if(!file_exists($file_name)){
        echo "文件不存在！";
        return ;
    }
    $fp = fopen($file_name,"r");
    $file_size = filesize($file_name);
    //获取文件大小
    //可通过file_size限制浏览器下载文件大小。
    //返回的文件
    header("Content-type:application/octet-stream");
    //按字节大小返回
    header("Accept-Ranges:bytes");
    //返回文件大小
    header("Accept-Length:$file_size");
    //客户端弹出对话框，对应的文件名
    header("Content-Disposition:attachment;filename=".$file_name);
    $buffer = 1024;  
    //定义缓冲区
    //为了下载的安全，最好使用文件字节读取计数器
    $file_count = 0;
    //feof用于判断文件是否读取到文档尾
    while(!feof($fp) && ($file_size-$file_count>0)){
    $file_data = fread($fp,$buffer);
    //统计读了多少个字节
    $file_count+$buffer;
    echo $file_data;   
    //把部分数据会送给浏览器
    }
    fclose($fp);
    //关闭文件
    }
?>
