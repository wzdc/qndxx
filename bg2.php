<?php
header('Content-Type:text/html;charset=UTF-8'); //设置HTML响应
$url=$_REQUEST["url"] ?? "";
$path=explode("?",explode("/bg2.php",$_SERVER['REQUEST_URI'])[1])[0];
$id=preg_match('/(?<=\/daxuexi\/).+(?=\/)/',$url,$id) ? $id[0] : "";
if(!$url) {
    if($path&&$path!="/") header("Location: https://h5.cyol.com/special/daxuexi$path"); 
} else if(!$path&&$url) {
    header("Location: bg2.php/$id/?url=$url");
} else if($id) {
    $html=file_get_contents($url);
    $str=preg_replace("/src=\"https?:\/\/h5.cyol.com\/special\/daxuexi\/$id\//","src=\"../../qndxx.php?url=http://h5.cyol.com/special/daxuexi/$id/",$html);
    $str=str_ireplace("window.location.href=\"m.html\";","window.location.href=\"../../qndxx.php?url=http://h5.cyol.com/special/daxuexi/$id/\";",$str);
    if($html!=$str) echo $str;
}