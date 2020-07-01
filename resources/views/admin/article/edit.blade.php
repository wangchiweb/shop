<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>文章修改</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
	<h1>文章修改
	<a href="{{url('article/index')}}" style="float:right;">
		<button type="button" class="btn btn-success">列表</button>
	</a>
	</h1>
</center>

<form class="form-horizontal" action="{{url('article/update/'.$res->article_id)}}" method="post" role="form" enctype="multipart/form-data">
	<!--三种生成表单令牌的方法-->
	@csrf
	
	<div class="form-group">
		<label for="firstname" class="col-sm-4 control-label">文章标题</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="firstname" name="article_title" value="{{$res->article_title}}" 
				   placeholder="请输入文章标题">
			<b style="color:red">{{$errors->first('article_title')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">文章分类</label>
		<div class="col-sm-2">
			<select name="tid" class="form-control">
				<option value="0">--请选择--</option> 
				@foreach($res1 as $v) 
				<option value="{{$v->tid}}"
				{{$res->tid==$v->tid?"selected":""}}>
					{{$v->tname}}
				</option>
				@endforeach
			</select>
			<b style="color:red">{{$errors->first('tname')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">文章重要性</label>
		<div class="col-sm-3"> @if($res->sex==1) checked @endif
			<input type="radio" id="lastname" name="article_importance" value="1" @if($res->article_importance==1) checked @endif>普通
			<input type="radio" id="lastname" name="article_importance" value="2" @if($res->article_importance==2) checked @endif>置顶
			<b style="color:red">{{$errors->first('article_importance')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">是否显示</label>
		<div class="col-sm-3">
			<input type="radio" id="lastname" name="is_show" value="1" @if($res->is_show==1) checked @endif>显示
			<input type="radio" id="lastname" name="is_show" value="2" @if($res->is_show==2) checked @endif>不显示
			<b style="color:red">{{$errors->first('is_show')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">原文章图片</label>
		<div class="col-sm-2">
			@if($res->article_img) 
			<img src="{{env('UPLOADS_URL')}}/{{$res->article_img}}" width="80px" height="60px"> 
			@endif
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-4 control-label">文章图片</label>
		<div class="col-sm-2">
			<input type="file" class="form-control" id="lastname" name="article_img">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>