<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>学生添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
	<h1>学生添加
	<a href="{{url('student/index')}}" style="float:right;">
		<button type="button" class="btn btn-success">列表</button>
	</a>
	</h1>
</center>

<form class="form-horizontal" action="{{url('student/store')}}" method="post" 
role="form" enctype="multipart/form-data">
	<!--三种生成表单令牌的方法-->
	@csrf
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">姓名</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="firstname" name="name" 
				   placeholder="请输入姓名">
			<b style="color:red">{{$errors->first('name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">年龄</label>
		<div class="col-sm-9">
			<input type="number" class="form-control" id="lastname" name="age" 
				   placeholder="请输入年龄">
			<b style="color:red">{{$errors->first('age')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">性别</label>
		<div class="col-sm-3">
			<input type="radio" id="lastname" name="sex" value="1" checked>男
			<input type="radio" id="lastname" name="sex" value="2">女
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">班级</label>
		<div class="col-sm-1">
			<select name="class" class="form-control">
				<option value="">请选择</option>
				<option value="1">A班</option>
				<option value="2">B班</option>
				<option value="3">C班</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生头像</label>
		<div class="col-sm-2">
			<input type="file" class="form-control" id="lastname" name="img">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-9">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>
<script>
	$(document).on('blur','input[name="name"]',function(){
		$(this).next().empty();
		var name=$(this).val();
		var obj=$(this);
		var reg=/^[\u4e00-\u9fa5\w]{2,15}$/;
		if(!reg.test(name)){
			$(this).next().text('姓名必须由中文、字母、数字、下划线，长度2-15位组成');
			return;
		}

		/*唯一性验证*/
		//第一种
		$.get('/student/checkname',{name:name},function(res){
			if(res.count){
				obj.next().text('姓名已存在');
			}
		},'json')
	})
</script>