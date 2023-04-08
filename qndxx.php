<?php
$url=$_REQUEST["url"] ?? ""; //获取传入的URL
header('Content-Type:text/html;charset=UTF-8'); //设置HTML响应
$html=file_get_contents($url); 
$id=preg_match('/(?<=\/special\/).+(?=\/)/',$url,$id) ? $id[0] : ""; 
$title=preg_match("/(?<=<title>).+(?=<\/title>)/",$html,$title) ? $title[0] : ""; //获取网页标题
?>
<!DOCTYPE html>
<html>
<head>
<title><?=$title?></title>
<meta charset="utf-8">
<style type="text/css">
/*清除边距*/
*{
    padding:0;
    margin:0;
}
html,body{
    height:100%;
}
/*设置宽高100%，放背景图，不重复，设置背景图的尺寸*/
.box{
    width:100%;
    height:100%;
    background-image: url("https://h5.cyol.com/special/<?=$id?>/images/end.jpg");
    background-repeat: no-repeat;
    background-size: 100% 100%; /*宽高都100%*/
}
</style>
</head>
<body>
<div class="box">
</div>
</body>
</html>