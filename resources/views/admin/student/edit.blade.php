<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>学生修改</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
	<h1>学生修改
	<a href="{{url('student/index')}}" style="float:right;">
		<button type="button" class="btn btn-success">列表</button>
	</a>
	</h1>
</center>

<form class="form-horizontal" action="{{url('student/update/'.$res->sid)}}" method="post" role="form" enctype="multipart/form-data">
	<!--三种生成表单令牌的方法-->
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">姓名</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="firstname" name="name" value="{{$res->name}}" 
				   placeholder="请输入姓名">
			<b style="color:red">{{$errors->first('name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">年龄</label>
		<div class="col-sm-9">
			<input type="number" class="form-control" id="lastname" name="age" value="{{$res->age}}" 
				   placeholder="请输入年龄">
			<b style="color:red">{{$errors->first('age')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">性别</label>
		<div class="col-sm-3">
			<input type="radio" id="lastname" name="sex" value="1" @if($res->sex==1) checked @endif>男
			<input type="radio" id="lastname" name="sex" value="2" @if($res->sex==2) checked @endif>女
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">班级</label>
		<div class="col-sm-1">
			<select name="class" class="form-control" id="lastname">
				<option value="">-请选择-</option>
				<option value="1" @if($res->class==1) selected @endif>A班</option>
				<option value="2" @if($res->class==2) selected @endif>B班</option>
				<option value="3" @if($res->class==3) selected @endif>C班</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">原学生头像</label>
		<div class="col-sm-9">
			@if($res->img) 
			<img src="{{env('UPLOADS_URL')}}/{{$res->img}}" width="80px" height="60px"> 
			@endif
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">学生头像</label>
		<div class="col-sm-9">
			<input type="file" class="form-control" id="lastname" name="img">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>