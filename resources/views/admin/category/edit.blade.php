<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品分类修改</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
	<h1>商品分类修改
	<a href="{{url('category/index')}}" style="float:right;">
		<button type="button" class="btn btn-success">列表</button>
	</a>
	</h1>
</center>

<form class="form-horizontal" action="{{url('category/update/'.$res->cate_id)}}" method="post" role="form">
	<!--三种生成表单令牌的方法-->
	@csrf
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="firstname" name="cate_name" value="{{$res->cate_name}}" placeholder="请输入分类名称">
			<b style="color:red">{{$errors->first('cate_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">父分类</label>
		<div class="col-sm-2">
			<select name="pid" class="form-control">
				<option value="0">--顶级分类--</option>
				@foreach($res1 as $v)
				<option value="{{$v->pid}}" @if($res->pid==$v->pid) selected @endif>
					{{$v->cate_name}}
				</option>
				@endforeach
			</select>

		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-2">
			<input type="radio" id="lastname" name="cate_show" value="1" @if($res->cate_show==1) checked @endif>是
			<input type="radio" id="lastname" name="cate_show" value="2" @if($res->cate_show==2) checked @endif>否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否在导航显示</label>
		<div class="col-sm-9">
			<input type="radio" id="lastname" name="cate_nav_show" value="1" @if($res->cate_nav_show==1) checked @endif>是
			<input type="radio" id="lastname" name="cate_nav_show" value="2" @if($res->cate_nav_show==2) checked @endif>否
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