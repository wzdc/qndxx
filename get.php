<?php
header("Content-type:text/html;charset=utf-8"); //设置HTML响应
//exit; //关闭接口 

$json=file_get_contents("https://qczj.h5yunban.com/qczj-youth-learning/cgi-bin/common-api/course/list?pageSize=1");
$json=json_decode($json,true); //获取数量
$json=file_get_contents("https://qczj.h5yunban.com/qczj-youth-learning/cgi-bin/common-api/course/list?pageSize=".$json["result"]["pagedInfo"]["total"]);
$list=json_decode($json,true)["result"]["list"]; //获取列表
$list=array_reverse($list); //倒序
$htmldata='';

foreach($list as $v)
{
    $url=$v["uri"]; //获取URL
    $id=preg_match('/(?<=\/daxuexi\/).+(?=\/)/',$url,$id) ? $id[0] : ""; //获取ID
    if(!$id||preg_match("/daxuexiall/",$id)) continue; //跳过无效链接
    $title=$v["title"]; //获取标题
    $htmldata.="<option value=\"$url\">$title</option>"; //拼接HTML
}

echo $htmldata;