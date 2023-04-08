qdurl="";
urlinput = "";
layui.use(function() {
    var form = layui.form;
    var layer = layui.layer
      , form = layui.form
      , laypage = layui.laypage
      , element = layui.element
      , laydate = layui.laydate
      , util = layui.util;
    form.on('select(qdlist)', function(data) {
        
        if (data.value == 'a') {
            document.getElementById('input').setAttribute('style', 'display:block');
            qdurl=document.getElementById('urlinput').value;
            document.getElementById('urlinput').setAttribute('lay-verify', 'url');
            form.render(null, 'url')
        } else {
            document.getElementById('input').style.display = "none";
            qdurl=data.value;
            document.getElementById('urlinput').setAttribute('lay-verify', "");
            form.render(null, 'url')
        }
    });
    
    form.on('submit(*)', function(data) {
        var index = layer.msg('正在跳转，请稍候...', {
            icon: 16,
            time: false,
            shade: 0.8
        });
        if(qdurl) data.field.url = qdurl;
        if (data.field.ui == 0) {
            location.href = "qndxx.php?url=" + data.field.url
        } else if (data.field.ui == 1) {
            location.href = "bg.php?url=" + data.field.url
        } else if (data.field.ui == 2) {
            location.href = "bg2.php?url=" + data.field.url
        } else {
            layer.close(index);
            layer.alert("你选择了一个未知页面", {
                icon: 2
            })
        }
        return false
    })
    
});