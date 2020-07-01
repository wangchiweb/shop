<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>后台登录</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
	<h1>
		后台登录
	</h1>
</center>

@if(session('msg'))
	<div class="alert alert-danger">{{session('msg')}}</div>
@endif
	

<form class="form-horizontal" action="{{url('login/logindo')}}" method="post" role="form">
	<!--三种生成表单令牌的方法-->
	@csrf
	
	<div class="form-group">
		<label for="firstname" class="col-sm-4 control-label">账号</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="firstname" name="admin_account" 
				   placeholder="请输入账号">
			<b style="color:red">{{$errors->first('admin_account')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">密码</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="lastname" name="admin_pwd" 
				   placeholder="请输入密码">
			<b style="color:red">{{$errors->first('admin_pwd')}}</b>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-10">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="remember"> 七天免登陆
				</label>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-4">
			<button type="submit" class="btn btn-default">登录</button>
		</div>
	</div>
</form>

</body>
</html>