<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>学生列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">电商</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li>
            	<a href="{{url('goods/index')}}">商品管理</a>
            </li>
            <li>
            	<a href="{{url('brand/index')}}">品牌管理</a>
            </li>
            <li>
            	<a href="{{url('category/index')}}">分类管理</a>
            </li>
            <li>
            	<a href="{{url('admin/index')}}">管理员管理</a>
            </li>
            <li>
            	<a href="{{url('student/index')}}">学生管理</a>
            </li>
            <li>
            	<a href="{{url('website/index')}}">友情链接管理</a>
            </li>
            <li>
            	<a href="{{url('article/index')}}">文章管理</a>
            </li>
        </ul>
    </div>
	</div>
</nav>

<center>
	<h1>学生列表
	<a href="{{url('student/create')}}" style="float:right;">
		<button type="button" class="btn btn-success">添加</button>
	</a>
	</h1>
</center>

<form action="">
	<div class="form-group">
		<div class="col-sm-2">
			<input type="text" class="form-control" id="firstname" 
			name="name" placeholder="请输入姓名关键字" 
			value="{{$name}}">
		</div>
		<input type="submit" class="btn btn-info" value="搜索">
	</div>
</form>

<table class="table table-hover">
	<thead>
		<tr>
			<th>学生id</th>
			<th>姓名</th>
			<th>年龄</th>
			<th>性别</th>
			<th>班级</th>
			<th>学生头像</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($res as $v)
		<tr>
			<td>{{$v->sid}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->age}}</td>
			<td>@if($v->sex==1) 男 @elseif($v->sex==2) 女 @endif</td>
			<td>@if($v->class==1) A班 @elseif($v->class==2) B班 @else C班 @endif</td>
			<td>
				@if($v->img) 
				<img src="{{env('UPLOADS_URL')}}/{{$v->img}}" 
				width="80px" height="60px"> 
				@endif
			</td>
			<td>
				<a href="{{url('student/edit/'.$v->sid)}}">
					<button type="button" class="btn btn-primary">修改</button>
				</a>
				<a href="{{url('student/destroy/'.$v->sid)}}">
					<button type="button" class="btn btn-danger">删除</button>
				</a>
			</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="6">{{$res->appends(['name'=>$name])->links()}}</td>
		</tr>
	</tbody>
</table>

</body>
</html>