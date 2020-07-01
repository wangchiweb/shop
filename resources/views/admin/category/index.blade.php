<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品分类添加</title>
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
	<h1>商品分类列表
	<a href="{{url('category/create')}}" style="float:right;">
		<button type="button" class="btn btn-success">添加</button>
	</a>
	</h1>
</center>

<table class="table table-hover">
	<thead>
		<tr>
			<th>分类id</th>
			<th>分类名称</th>
			<th>是否显示</th>
			<th>是否在导航显示</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($res as $v)
		<tr>
			<td>{{$v->cate_id}}</td>
			<td>
				{{str_repeat('——',$v->level)}}
				{{$v->cate_name}}
			</td>
			<td>{{$v->cate_show}}</td>
			<td>{{$v->cate_nav_show}}</td>
			<td>
				<a href="{{url('category/edit/'.$v->cate_id)}}">
					<button type="button" class="btn btn-primary">修改</button>
				</a>
				<a href="{{url('category/destroy/'.$v->cate_id)}}">
					<button type="button" class="btn btn-danger">删除</button>
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

</body>
</html>