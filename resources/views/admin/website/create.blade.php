<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>友情链接添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
	<h1>友情链接添加
	<a href="{{url('website/index')}}" style="float:right;">
		<button type="button" class="btn btn-success">列表</button>
	</a>
	</h1>
</center>

<form class="form-horizontal" action="{{url('website/store')}}" method="post" role="form" enctype="multipart/form-data">
	<!--三种生成表单令牌的方法-->
	@csrf
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网站名称</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="firstname" name="website_name" 
				   placeholder="请输入网站名称">
			<b style="color:red">{{$errors->first('website_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站网址</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="lastname" name="website_url" 
				   placeholder="请输入网站网址">
			<b style="color:red">{{$errors->first('website_url')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">链接类型</label>
		<div class="col-sm-3">
			<input type="radio" id="lastname" name="website_type" value="1" checked>LOGO链接
			<input type="radio" id="lastname" name="website_type" value="2">文字链接
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站图片</label>
		<div class="col-sm-2">
			<input type="file" class="form-control" id="lastname" name="website_img">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站联系人</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="lastname" name="website_man" 
				   placeholder="请输入网站联系人">
			<b style="color:red">{{$errors->first('website_man')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网站介绍</label>
		<div class="col-sm-9">
			<textarea name="website_desc" id="lastname" placeholder="请输入网站介绍" class="form-control" rows="5"></textarea> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-3">
			<input type="radio" id="lastname" name="is_show" value="1" checked>是
			<input type="radio" id="lastname" name="is_show" value="2">否
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>
<script>
	$(document).on('blur','input[name="website_name"]',function(){
		alert(74585);
		$(this).next().empty();
		var website_name=$(this).val();
		var obj=$(this);
		var reg=/^[\u4e00-\u9fa5\w]{2,15}$/;
		if(!reg.test(website_name)){
			$(this).next().text('网站名称必须由中文、字母、数字、下划线，长度2-15位组成');
			return;
		}

		/*唯一性验证*/
		//第一种
		$.get('/website/checkname',{website_name:website_name},function(res){
			if(res.count){
				obj.next().text('网站名称已存在');
			}
		},'json')
	})
</script