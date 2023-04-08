<?php
header("Content-type:text/html;charset=utf-8"); //设置HTML响应

$json=file_get_contents("https://qczj.h5yunban.com/qczj-youth-learning/cgi-bin/common-api/course/list?pageSize=1");
$json=json_decode($json,true); //获取数量
$json=file_get_contents("https://qczj.h5yunban.com/qczj-youth-learning/cgi-bin/common-api/course/list?pageSize=".$json["result"]["pagedInfo"]["total"]);
$list=json_decode($json,true)["result"]["list"]; //获取列表
$list=array_reverse($list); //倒序
$htmldata='<option value="a">其他</option>';

foreach($list as $v)
{
    $url=$v["uri"]; //获取URL
    $id=preg_match('/(?<=\/daxuexi\/).+(?=\/)/',$url,$id) ? $id[0] : ""; //获取ID
    if(!$id||preg_match("/daxuexiall/",$id)) continue; //跳过无效链接
    $title=$v["title"]; //获取标题
    $htmldata.="<option value=\"$url\">$title</option>"; //拼接HTML
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" /><meta name="keywords" content="青年大学习截图,青年大学习工具" /><meta name="description" content="高仿青年大学习完成页面，可用于青年大学习完成页截图，支持电脑版和手机版页面，在线获取青年大学习完成页面，完全免费且开源。" /><title>高仿青年大学习完成页</title><link rel="stylesheet" href="layui/css/layui.css" media="all" /></head><body><div class="layui-card"><div class="layui-card-header">     高仿青年大学习完成页</div><div class="layui-card-body"><blockquote class="layui-elem-quote" style="margin-top: 30px;"><div class="layui-text"><ul><li>本页面为高仿页并非官方页，切勿混淆！</li><li>列表并非所有青年大学习，本程序不支持过旧的青年大学习链接</li><li>如果页面空白一般是链接输入有误 可以尝试从<a href="list.php?url=https://h5.cyol.com/special/daxuexi/daxuexiall/m.html?t=1">青年大学习完整版合集</a>里复制链接</li></ul></div></blockquote><form class="layui-form" style="padding: 20px 20px 10px 20px;background-color: #fff;"><div class="layui-form-item"><label class="layui-form-label">选择链接</label><div class="layui-input-block"><select name="qdlist" lay-filter="qdlist" id="qdlist"><?=$htmldata?></select></div></div><div id="input" class="layui-form-item"><label class="layui-form-label"></label><div class="layui-input-block"><input type="text" name="url" id="urlinput" lay-verify="url" placeholder="请输入青年大学习链接" autocomplete="off" class="layui-input" value="<?= $_GET["url"]??"" ?>" /></div></div><div class="layui-form-item"><label class="layui-form-label">选择页面</label><div class="layui-input-block"><select name="ui" lay-filter="aihao"><option value="0">手机版</option><option value="2">电脑版</option></select></div></div><div class="layui-form-item"><div class="layui-input-block"><button class="layui-btn" lay-submit="" lay-filter="*">确定</button></div></div></form></div></div><script type="text/javascript" src="layui/layui.js"></script><script type="text/javascript">qdurl="";urlinput="";layui.use(function(){var form=layui.form;var layer=layui.layer,form=layui.form,laypage=layui.laypage,element=layui.element,laydate=layui.laydate,util=layui.util;form.on('select(qdlist)',function(data){if(data.value=='a'){document.getElementById('input').setAttribute('style','display:block');qdurl=document.getElementById('urlinput').value;document.getElementById('urlinput').setAttribute('lay-verify','url');form.render(null,'url')}else{document.getElementById('input').style.display="none";qdurl=data.value;document.getElementById('urlinput').setAttribute('lay-verify',"");form.render(null,'url')}});form.on('submit(*)',function(data){var index=layer.msg('正在跳转，请稍候...',{icon:16,time:false,shade:0.8});if(qdurl)data.field.url=qdurl;if(data.field.ui==0){location.href="qndxx.php?url="+data.field.url}else if(data.field.ui==1){location.href="bg.php?url="+data.field.url}else if(data.field.ui==2){location.href="bg2.php?url="+data.field.url}else{layer.close(index);layer.alert("你选择了一个未知页面",{icon:2})}return false})});</script></body></html>