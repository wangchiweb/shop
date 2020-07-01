<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品品牌修改</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
	<h1>商品品牌修改
	<a href="{{url('brand/index')}}" style="float:right;">
		<button type="button" class="btn btn-success">列表</button>
	</a>
	</h1>
</center>

<form class="form-horizontal" action="{{url('brand/update/'.$res->brand_id)}}" method="post" role="form" enctype="multipart/form-data">
	<!--三种生成表单令牌的方法-->
	@csrf
	<input type="hidden" name="brand_id" value="{{$res->brand_id}}">
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="firstname" name="brand_name" value="{{$res->brand_name}}" placeholder="请输入品牌名称">
			<b style="color:red">{{$errors->first('brand_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="lastname" name="brand_url" value="{{$res->brand_url}}" placeholder="请输入品牌网址">
			<b style="color:red">{{$errors->first('brand_url')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">原品牌logo</label>
		<div class="col-sm-2">
			@if($res->brand_logo) 
			<img src="{{env('UPLOADS_URL')}}/{{$res->brand_logo}}" width="80px" height="60px"> 
			@endif
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌logo</label>
		<div class="col-sm-2">
			<input type="file" class="form-control" id="lastname" name="brand_logo">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌描述</label>
		<div class="col-sm-9">
			<textarea name="brand_desc" id="lastname" placeholder="请输入品牌描述" class="form-control" rows="5">
				{{$res->brand_desc}}
			</textarea> 
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