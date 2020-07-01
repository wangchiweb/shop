<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员修改</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
	<h1>管理员修改
	<a href="{{url('admin/index')}}" style="float:right;">
		<button type="button" class="btn btn-success">列表</button>
	</a>
	</h1>
</center>

<form class="form-horizontal" action="{{url('admin/update/'.$res->admin_id)}}" method="post" role="form" enctype="multipart/form-data">
	<!--三种生成表单令牌的方法-->
	@csrf
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">账号</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="firstname" name="admin_account" value="{{$res->admin_account}}" 
				   placeholder="请输入账号">
			<b style="color:red">{{$errors->first('admin_account')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="lastname" name="admin_pwd" value="{{decrypt($res->admin_pwd)}}" 
				   placeholder="请输入密码">
			<b style="color:red">{{$errors->first('admin_pwd')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">原头像</label>
		<div class="col-sm-2">
			@if($res->my_img) 
			<img src="{{env('UPLOADS_URL')}}/{{$res->my_img}}" width="80px" height="60px"> 
			@endif
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">我的头像</label>
		<div class="col-sm-2">
			<input type="file" class="form-control" id="lastname" name="my_img">
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