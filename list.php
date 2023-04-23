<?php
header('Content-Type:text/html;charset=UTF-8'); //设置HTML响应
$url=$_REQUEST["url"] ?? "";
$path=explode("?",explode("/list.php",$_SERVER['REQUEST_URI'])[1])[0]; //preg_match("/(?<=\/list\.php).*(?=\?|$)/U",$_SERVER["REQUEST_URI"],$path) ? $path[0] : "";
$id=preg_match('/(?<=\/special\/).+(?=\/)/',$url,$id) ? $id[0] : "";
if(!$url) {
    if($path&&$path!="/") header("Location: https://h5.cyol.com/special$path"); 
} else if(!preg_match("/daxuexiall/",$url)) {
    header("Location: ../?url=$url"); 
} else if(!$path) {
    header("Location: list.php/$id/?url=$url");
} else if($path=="/") {
    if($id) header("Location: $id/?url=$url");
} else {
    $options = array(
        'http' => array(
            'method' => 'GET',
            'header' => 'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 15_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/8.0.13(0x18000d22) NetType/WIFI Language/zh-Hant-TW\r\n'
            )
        );
    $data=file_get_contents($url,false,stream_context_create($options));
    $str=str_ireplace("GetQueryValue('t')","1" , $data); //禁用电脑UA自动跳转
    $str=preg_replace("/https?:\/\/h5.cyol.com\/special/","../../?url=http://h5.cyol.com/special",$str); //将URL添加../?url=前缀
    echo $str;
}