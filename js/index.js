qdurl="";urlinput="";const e=(new URLSearchParams(window.location.search)).get("url");e&&(document.getElementById("urlinput").value=e);layui.use(function(){var form=layui.form;var layer=layui.layer,form=layui.form,laypage=layui.laypage,element=layui.element,laydate=layui.laydate,util=layui.util;form.on('select(qdlist)',function(data){let options=document.querySelectorAll('#qdlist option[value="b"]');if(options.length>0){let lastOption=options[options.length-1];lastOption.parentNode.removeChild(lastOption)}if(data.value=='a'){document.getElementById('input').setAttribute('style','display:block');qdurl=document.getElementById('urlinput').value;document.getElementById('urlinput').setAttribute('lay-verify','url');form.render(null,'url')}else if(data.value=='b'){document.getElementById('input').setAttribute('style','display:block');document.getElementById('urlinput').value=urlinput;document.getElementById("qdlist").innerHTML+='<option value="b" disabled>正在载入</option>';form.render('select');form.render(null,'url');page++;$.ajax({type:'get',url:'api/',data:{"page":page},dataType:'text',success:function(data){let options=document.querySelectorAll('#qdlist option[value="b"]');if(options.length>0){let lastOption=options[options.length-1];lastOption.parentNode.removeChild(lastOption)}document.getElementById("qdlist").innerHTML+=data;document.getElementById('input').setAttribute('style','display:block');qdurl=urlinput;form.render('select')},error:function(){let options=document.querySelectorAll('#qdlist option[value="b"]');if(options.length>0){let lastOption=options[options.length-1];lastOption.parentNode.removeChild(lastOption)}document.getElementById("qdlist").innerHTML+='<option value="b" disabled>载入失败</option>';document.getElementById('input').setAttribute('style','display:block');qdurl=urlinput;form.render('select')}})}else{document.getElementById('input').style.display="none";qdurl=data.value;document.getElementById('urlinput').setAttribute('lay-verify',"");form.render(null,'url')}});page=1;$.ajax({type:'get',url:'api/',data:{},dataType:'text',success:function(data){document.getElementById("qdlist").innerHTML='<option value="a">其他</option>'+data;form.render('select')},error:function(){document.getElementById("qdlist").innerHTML='<option value="a">其他</option><option value="b" disabled>载入失败</option>';form.render('select')}});form.on('submit(*)',function(data){var index=layer.msg('正在跳转，请稍候...',{icon:16,time:false,shade:0.8});if(qdurl)data.field.url=qdurl;if(data.field.ui==0){location.href="qndxx.php?url="+data.field.url}else if(data.field.ui==1){location.href="bg.php?url="+data.field.url}else if(data.field.ui==2){location.href="bg2.php?url="+data.field.url}else{layer.close(index);layer.alert("你选择了一个未知页面",{icon:2})}return false})});