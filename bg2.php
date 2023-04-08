<?php
$url2=$_REQUEST["url"] ?? "";
$url=explode("?",explode("/bg2.php",$_SERVER['REQUEST_URI'])[1])[0];
header('Content-Type:text/html;charset=UTF-8'); //设置HTML响应

$id=preg_match('/(?<=\/daxuexi\/).+(?=\/)/',$url2,$id) ? $id[0] : "";
if(!$url2)
header("Location: https://h5.cyol.com/special/daxuexi/$url");
else if(!$url&&$url2)
header("Location: bg2.php/$id/?url=$url2");
else if($id)
{
    $html=file_get_contents("https://h5.cyol.com/special/daxuexi/$id/");
    $str=preg_replace("/src=\"https?:\/\/h5.cyol.com\/special\/daxuexi\/$id\//","src=\"../../qndxx.php?url=http://h5.cyol.com/special/daxuexi/$id/",$html);
    $str=str_ireplace("window.location.href=\"m.html\";","window.location.href=\"../../qndxx.php?url=http://h5.cyol.com/special/daxuexi/$id/\";",$str);
    echo $str;
}