<?php
$url2=$_REQUEST["url"] ?? "";
$url=explode("?",explode("/list.php",$_SERVER['REQUEST_URI'])[1])[0]; 
header('Content-Type:text/html;charset=UTF-8'); //设置HTML响应
$id=preg_match('/(?<=\/special\/).+(?=\/)/',$url2,$id) ? $id[0] : "";

if(!$url2)
header("Location: https://h5.cyol.com/special/$url");
else if(!preg_match("/daxuexiall/",$url2))
header("Location: ../?url=$url2"); 
else if(!$url&&$url2)
header("Location: list.php/$id/?url=$url2");
else if($url=="/")
if($id) header("Location: $id/?url=$url2"); else{}
else
{
    $options = array(
        'http' => array(
            'method' => 'GET',
            'header' => 'User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 15_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 MicroMessenger/8.0.13(0x18000d22) NetType/WIFI Language/zh-Hant-TW\r\n'
            )
        );
    $data=file_get_contents($url2,false,stream_context_create($options));
    $str=str_ireplace("GetQueryValue('t')","1" , $data); //禁用电脑UA自动跳转
    $str=str_ireplace("http://h5.cyol.com/special","../../?url=http://h5.cyol.com/special" , $str);
    $str=str_ireplace("https://h5.cyol.com/special","../../?url=https://h5.cyol.com/special" , $str); //将URL添加../?url=前缀
    echo $str;
}